<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\StaffLog;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Thống kê hiệu suất làm việc dựa trên Logs
        $stats = [
            'total_actions' => StaffLog::where('user_id', $user->id)->count(),
            'check_ins' => StaffLog::where('user_id', $user->id)->where('action', 'check_in')->count(),
            'bookings' => StaffLog::where('user_id', $user->id)->where('action', 'create_booking')->count(),
            'money_confirmed' => StaffLog::where('user_id', $user->id)->where('action', 'confirm_money')->count(),
        ];

        // Lịch sử hoạt động gần đây của riêng nhân viên này
        $recentLogs = StaffLog::where('user_id', $user->id)
            ->latest()
            ->take(15)
            ->get();

        return view('staff.profile.index', compact('user', 'stats', 'recentLogs'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'address' => 'nullable|string|max:500',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
        ], [
            'name.required' => 'Họ và tên là bắt buộc.',
            'phone.unique' => 'Số điện thoại này đã có người sử dụng.',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
        ]);

        StaffLog::create([
            'user_id' => $user->id,
            'action' => 'update_profile',
            'description' => 'Cập nhật thông tin cá nhân.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Hồ sơ của bạn đã được cập nhật thành công!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min' => 'Mật khẩu mới phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không chính xác.');
        }

        Auth::user()->update([
            'password' => Hash::make($request->password)
        ]);

        StaffLog::create([
            'user_id' => Auth::id(),
            'action' => 'change_password',
            'description' => 'Đổi mật khẩu tài khoản.',
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
