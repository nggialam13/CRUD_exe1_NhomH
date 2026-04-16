<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // dinh hanh
    // Hiển thị form đăng nhập
    public function login()
    {
        return view('crud_user.login'); // file login.blade.php
    }

    // Xử lý đăng nhập
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            return redirect()->intended('/users')->with('success', 'Đăng nhập thành công!');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ])->onlyInput('email');
    }
    //logout
    public function logout(Request $request)
    {
        Auth::logout();           // Xóa thông tin đăng nhập
        $request->session()->invalidate();    // Hủy toàn bộ session
        $request->session()->regenerateToken(); // Tạo CSRF token mới

        return redirect()->route('login')->with('success', 'Đã đăng xuất.');
    }
    //gialam
    public function index(Request $request)
    {
        // lấy danh sách user, có phân trang và tìm kiếm
        $search = $request->input('search');
        // nếu có search thì lọc theo name hoặc email, nếu không thì lấy tất cả
        $users = User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
            ->orderBy('id', 'desc')
            ->paginate(5);
        // trả về view list với dữ liệu users và search
        return view('crud_user.list', compact('users', 'search'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('crud_user.detail', compact('user'));
    }

    public function create()
    {
        // trả về form create
        return view('crud_user.register');
    }

    public function store(Request $request)
    {  // xu lý lưu user mới
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|max:20',
            'address' => 'nullable|max:255',
        ]);

        $data = $request->all();
        // sử lý mã hóa password
        //$data['password'] = bcrypt($request->password);
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        // trả về form edit
        $user = User::findOrFail($id);
        return view('crud_user.update', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // xử lý update user
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $data = $request->all();

        if (!empty($request->password)) {
            $data['password'] = $request->password;
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        // xử lý xóa user
        $user = User::findOrFail($id);
        $user->delete(); // soft delete

        return redirect()->back()->with('success', 'Xóa user thành công (soft delete)');
    }
    // Hiển thị danh sách user đã xóa
    public function trashed()
    {
        $users = User::onlyTrashed()->paginate(10);
        return view('crud_user.trashed', compact('users'));
    }
    // Khôi phục user đã xóa
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->back()->with('success', 'Khôi phục user thành công');
    }
    // Xóa vĩnh viễn
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->back()->with('success', 'Đã xóa vĩnh viễn');
    }
}
