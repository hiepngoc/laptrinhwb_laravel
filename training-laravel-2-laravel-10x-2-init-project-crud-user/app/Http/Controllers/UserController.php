<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * View user detail page
     */
    public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('admin.users.read', ['messi' => $user]); // Tạo view admin.users.read
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        User::destroy($user_id);

        return redirect("admin/users")->withSuccess('Người dùng đã được xóa'); // Chuyển hướng đến route quản lý user
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('admin.users.update', ['user' => $user]); // Tạo view admin.users.update
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . $input['id'],
            'password' => 'required|min:6',
        ]);

        $user = User::find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']); // Mã hóa lại mật khẩu khi cập nhật
        $user->save();

        return redirect("admin/users")->withSuccess('Thông tin người dùng đã được cập nhật'); // Chuyển hướng đến route quản lý user
    }

    /**
     * List of users (resource controller index method)
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users')); // Tạo view admin.users.index
    }
    public function show(Tour $tour)
{
    return view('tours.show', compact('tour')); // Bạn cần tạo view này: resources/views/tours/show.blade.php
}

    // Các phương thức resource controller khác (show, edit, destroy) có thể được thêm vào đây
}