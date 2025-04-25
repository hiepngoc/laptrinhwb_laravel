<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Đảm bảo import model User
use Illuminate\Support\Facades\Hash; // Đảm bảo import Hash để mã hóa mật khẩu

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ngochiep', // Thay 'Admin User' bằng tên bạn muốn cho tài khoản admin
            'email' => 'admin@example.com', // Thay 'admin@example.com' bằng địa chỉ email bạn muốn dùng cho admin
            'password' => Hash::make('123456789'), // **Quan trọng:** Thay 'your_admin_password' bằng mật khẩu an toàn bạn muốn đặt cho tài khoản admin
            'is_admin' => true, // Đặt giá trị này là true (hoặc 1 tùy thuộc vào kiểu dữ liệu cột is_admin của bạn) để đánh dấu đây là tài khoản admin
        ]);
    }
}