<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('customer.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|unique:users,phone,' . $user->id,
            'avatar' => 'nullable|image|max:2048' // Nếu có tính năng upload ảnh
        ]);

        // Nếu có xử lý upload avatar thì viết thêm logic ở đây

        $user->update($validated);
        
        return back()->with('success', 'Cập nhật thông tin cá nhân thành công');
    }
}