<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //hiển thì form dang nhập
    public function loginForm()
    {
        return view('auth.login');
    }
    //hiển thị form đăng ký
    public function registerForm(){
        return view('auth.register');
    }
    //xử lý đăng ky
    public function register(Request $request){
        //validate dữ liệu
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role' => 'customer',
            'status' => 'active',
        ]);
        return redirect()->route('login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập.');
    }
    public function login(Request $request){
        //validate dữ liệu
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'active',
        ])){
            $user = Auth::user();
            if($user->role == 'admin') return redirect('/admin');
            if($user->role == 'staff') return redirect('/staff');
            return redirect('/home');
        }
        return back()->with('error', 'Email hoặc mật khẩu không đúng.');
    }
    //xử lý đăng xuất
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
