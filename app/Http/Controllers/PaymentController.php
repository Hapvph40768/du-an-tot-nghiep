<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function index()
    {
        return view('checkout.checkout');
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:vnpay,momo,bank_transfer,cod'
        ]);

        return DB::transaction(function () use ($request) {

            $order = Order::create([
                'user_id' => auth()->id() ?? 1,
                'order_code' => 'ORD-' . time(),
                'amount' => 50000,
                'status' => 'pending',
                'payment_method' => $request->payment_method
            ]);

            switch ($request->payment_method) {

                case 'vnpay':
                    return $this->payWithVnpay($order);

                case 'momo':
                    return redirect()->route('checkout.result')->with([
                        'status' => 'success',
                        'order' => $order
                    ]);

                case 'bank_transfer':
                    return redirect()->route('checkout.bank_transfer', $order->id);

                case 'cod':
                    return redirect()->route('checkout.result')->with([
                        'status' => 'cod',
                        'order' => $order
                    ]);
            }
        });
    }

    private function payWithVnpay(Order $order)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_HashSecret = env('VNP_HASH_SECRET', 'TESTSECRET');

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => env('VNP_TMN_CODE', 'TESTCODE'),
            "vnp_Amount" => $order->amount * 100,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => "vn",
            "vnp_OrderInfo" => "Thanh toan don hang " . $order->order_code,
            "vnp_OrderType" => "billpayment",
            "vnp_ReturnUrl" => route('checkout.vnpay.return'),
            "vnp_TxnRef" => $order->order_code
        ];

        ksort($inputData);

        $query = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $query, $vnp_HashSecret);

        $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $secureHash;

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $orderCode = $request->vnp_TxnRef;

        $order = Order::where('order_code', $orderCode)->first();

        $status = 'fail';

        if ($request->vnp_ResponseCode == '00') {
            $order->update(['status' => 'paid']);
            $status = 'success';
        } else {
            $order->update(['status' => 'failed']);
        }

        return view('checkout.payment_result', [
            'status' => $status,
            'order' => $order
        ]);
    }

    public function bankTransfer(Order $order)
    {
        return view('checkout.bank_transfer', compact('order'));
    }

    public function uploadBankTransfer($id)
    {
        $order = Order::findOrFail($id);

        $order->update([
            'status' => 'waiting_verify'
        ]);

        return redirect()->route('checkout.result')->with([
            'status' => 'waiting',
            'order' => $order
        ]);
    }

    public function result()
    {
        if (!session('status')) {
            return redirect()->route('checkout.index');
        }

        return view('checkout.payment_result', [
            'status' => session('status'),
            'order' => session('order')
        ]);
    }
}