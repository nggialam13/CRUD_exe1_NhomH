<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            // role mặc định là 0 (user) do database default 0
        ]);

        return redirect()->back()->with('success', 'Đăng ký thành công');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->route('users.index')->with('success', 'Đăng nhập thành công!');
            }
        }

        return back()->withErrors(['email' => 'Sai tài khoản hoặc mật khẩu']);
    }
}