<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:6',
            'role' => 'in:admin,staff,customer',
            'status' => 'in:active,blocked',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'Tạo người dùng thành công');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'role' => 'in:admin,staff,customer',
            'status' => 'in:active,blocked',
        ]);

        $user->update($validated);
        
        return redirect()->route('admin.users.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công');
    }
}