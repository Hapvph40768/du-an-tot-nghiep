<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\BookingSuccessMail;

class PaymentController extends Controller
{
    // Hiển thị trang chọn phương thức thanh toán
    public function checkout(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() || $booking->status !== 'pending') {
            return redirect()->route('customer.bookings.index')->with('error', 'Đơn hàng không hợp lệ.');
        }

        return view('customer.payment.checkout', compact('booking'));
    }

    // Xử lý thanh toán
    public function process(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_method' => 'required|in:vnpay,momo,cash',
        ]);

        if ($request->payment_method === 'vnpay') {
            return $this->vnpayProcess($booking);
        }

        if ($request->payment_method === 'cash') {
            return $this->cashProcess($booking);
        }

        return back()->with('error', 'Phương thức thanh toán không hợp lệ.');
    }

    private function cashProcess(Booking $booking)
    {
        DB::beginTransaction();
        try {
            // Vé phải được xuất để giữ chỗ vĩnh viễn
            Ticket::where('booking_id', $booking->id)->update([
                'status' => 'confirmed'
            ]);

            // Extend lock to ensure the seat is not released
            \App\Models\SeatLock::where('booking_id', $booking->id)->update([
                'locked_until' => now()->addYears(100)
            ]);

            $booking->update(['status' => 'paid']);
            DB::commit();

            // Gửi email thông báo đặt vé thành công
            try {
                $booking->load(['trip.route.startLocation', 'trip.route.endLocation', 'tickets.seat', 'pickupPoint', 'dropoffPoint']);
                Mail::to($booking->user->email)->send(new BookingSuccessMail($booking));
            } catch (\Exception $e) {
                Log::error('Gửi email đặt vé thất bại: ' . $e->getMessage());
            }

            return redirect()->route('customer.bookings.show', $booking->id)
                ->with('success', 'Đặt vé thành công! Vui lòng thanh toán tiền mặt tại quầy / nhà xe trước giờ khởi hành.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('customer.bookings.show', $booking->id)->with('error', 'Lỗi lưu dữ liệu: ' . $e->getMessage());
        }
    }

    private function vnpayProcess(Booking $booking)
    {
        $vnp_TmnCode = config('services.vnpay.tmn_code');
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $vnp_Url = config('services.vnpay.url');
        $vnp_Returnurl = url(config('services.vnpay.return_url'));
        
        $vnp_TxnRef = $booking->id . '_' . time(); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toan ve xe don hang " . $booking->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $booking->total_amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = config('services.vnpay.hash_secret');
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $bookingId = explode('_', $inputData['vnp_TxnRef'])[0] ?? 0;
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return redirect()->route('customer.home')->with('error', 'Không tìm thấy đơn đặt vé.');
        }

        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == '00') {
                // Success
                if ($booking->status === 'paid') {
                    return redirect()->route('customer.bookings.show', $booking->id)->with('success', 'Thanh toán VNPay thành công!');
                }

                DB::beginTransaction();
                try {
                    Payment::create([
                        'booking_id' => $booking->id,
                        'payment_method' => 'vnpay',
                        'amount' => $booking->total_amount,
                        'status' => 'success',
                        'transaction_code' => $inputData['vnp_TransactionNo'],
                    ]);

                    $booking->update(['status' => 'paid']);

                    Ticket::where('booking_id', $booking->id)->update([
                        'status' => 'confirmed'
                    ]);

                    \App\Models\SeatLock::where('booking_id', $booking->id)->update([
                        'locked_until' => now()->addYears(100)
                    ]);

                    DB::commit();

                    // Gửi email thông báo đặt vé thành công
                    try {
                        $booking->load(['trip.route.startLocation', 'trip.route.endLocation', 'tickets.seat', 'pickupPoint', 'dropoffPoint']);
                        Mail::to($booking->user->email)->send(new BookingSuccessMail($booking));
                    } catch (\Exception $ex) {
                        Log::error('Gửi email đặt vé thất bại: ' . $ex->getMessage());
                    }

                    return redirect()->route('customer.bookings.show', $booking->id)->with('success', 'Thanh toán VNPay thành công. Vé của bạn đã được xuất và gửi về email!');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('customer.bookings.show', $booking->id)->with('error', 'Lỗi lưu dữ liệu: ' . $e->getMessage());
                }
            } else {
                return redirect()->route('customer.bookings.show', $booking->id)->with('error', 'Thanh toán VNPay bị hủy hoặc không thành công.');
            }
        } else {
            return redirect()->route('customer.payment.checkout', $booking->id)->with('error', 'Chữ ký phản hồi VNPay không hợp lệ.');
        }
    }

    private function momoProcess(Booking $booking)
    {
        $endpoint = config('services.momo.url');
        $partnerCode = config('services.momo.partner_code');
        $accessKey = config('services.momo.access_key');
        $secretKey = config('services.momo.secret_key');
        
        $orderInfo = "Thanh toan don ban ve xe so " . $booking->id;
        $amount = (string) $booking->total_amount;
        $orderId = $booking->id . '_' . time();
        $redirectUrl = url('/payment/momo/return');
        $ipnUrl = url('/payment/momo/return');
        $extraData = "";
        $requestId = time() . "";
        $requestType = "captureWallet";
        
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        
        $response = \Illuminate\Support\Facades\Http::post($endpoint, $data);
        $result = $response->json();
        
        if (isset($result['payUrl'])) {
            return redirect($result['payUrl']);
        }
        
        return back()->with('error', 'Lỗi kết nối API MoMo. Nội dung lỗi: ' . ($result['message'] ?? ''));
    }

    public function momoReturn(Request $request)
    {
        $partnerCode = config('services.momo.partner_code');
        $accessKey = config('services.momo.access_key');
        $secretKey = config('services.momo.secret_key');
        
        $orderId = $request->orderId;
        $bookingId = explode('_', $orderId)[0] ?? 0;
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return redirect()->route('customer.home')->with('error', 'Không tìm thấy đơn đặt vé.');
        }

        if ($request->resultCode == 0) {
            if ($booking->status === 'paid') {
                return redirect()->route('customer.bookings.show', $booking->id)->with('success', 'Thanh toán MoMo thành công!');
            }

            DB::beginTransaction();
            try {
                Payment::create([
                    'booking_id' => $booking->id,
                    'payment_method' => 'momo',
                    'amount' => $booking->total_amount,
                    'status' => 'success',
                    'transaction_code' => $request->transId ?? strtoupper(Str::random(10)),
                ]);

                $booking->update(['status' => 'paid']);

                Ticket::where('booking_id', $booking->id)->update([
                    'status' => 'confirmed'
                ]);

                \App\Models\SeatLock::where('booking_id', $booking->id)->update([
                    'locked_until' => now()->addYears(100)
                ]);

                DB::commit();

                // Gửi email thông báo đặt vé thành công
                try {
                    $booking->load(['trip.route.startLocation', 'trip.route.endLocation', 'tickets.seat', 'pickupPoint', 'dropoffPoint']);
                    Mail::to($booking->user->email)->send(new BookingSuccessMail($booking));
                } catch (\Exception $ex) {
                    Log::error('Gửi email đặt vé thất bại: ' . $ex->getMessage());
                }

                return redirect()->route('customer.bookings.show', $booking->id)->with('success', 'Thanh toán qua Ví MoMo thành công. Vé của bạn đã được xuất và gửi về email!');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('customer.bookings.show', $booking->id)->with('error', 'Lỗi lưu dữ liệu: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('customer.payment.checkout', $booking->id)->with('error', 'Thanh toán MoMo thất bại/bị hủy.');
        }
    }
}