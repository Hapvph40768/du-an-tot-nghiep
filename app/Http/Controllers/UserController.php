<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()
            ->where('id', '!=', auth()->id())  
            ->when(request('search'), function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%')
                    ->orWhere('phone', 'like', '%' . request('search') . '%');
            })
            ->when(request('role'), fn($q) => $q->where('role', request('role')))
            ->when(request('status'), fn($q) => $q->where('status', request('status')))
            ->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->id === auth()->id()) {
            abort(403);
        }

        $newStatus = $user->status === 'active' ? 'blocked' : 'active';
        $user->update(['status' => $newStatus]);

        $message = $newStatus === 'active' ? 'Đã kích hoạt' : 'Đã chặn';
        return back()->with('success', $message . ' người dùng thành công.');
    }
}
