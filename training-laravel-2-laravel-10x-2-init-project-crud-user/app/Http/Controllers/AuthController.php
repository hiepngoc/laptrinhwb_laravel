<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login'); // Chú ý: Thay đổi đường dẫn view nếu cần
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->is_admin === 1) { // So sánh với giá trị số nguyên 1
                return redirect()->route('admin.home')->withSuccess('Đăng nhập quản trị thành công!');
            } else {
                return redirect()->route('home')->withSuccess('Đăng nhập thành công!');
            }
        }

        return redirect("login")->withSuccess('Thông tin đăng nhập không chính xác');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create'); // Chú ý: Thay đổi đường dẫn view nếu cần
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect("login");
    }

    /**
     * Sign out
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
    public function home()
    {
        return view('crud_user.home'); // Assuming you have a home.blade.php
    }
    public function adminHome()
    {
        return view('crud_user.adminhome'); // Assuming you have a home.blade.php
    }
}