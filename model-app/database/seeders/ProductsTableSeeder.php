<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Vô hiệu hóa kiểm tra khóa ngoại nếu cần
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate(); // Xóa dữ liệu cũ
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Tạo dữ liệu mẫu
        for ($i = 1; $i <= 100; $i++) {
            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'image' => 'https://via.placeholder.com/150', // Bạn có thể thay thế bằng URL ảnh thật
                'price' => rand(10000, 1000000) / 100, // Giá từ 100 đến 10000 VND
                'quantity' => rand(1, 100), // Số lượng từ 1 đến 100
                'description' => 'Description for product ' . $i,
                'created_at' => Carbon::now()->subDays(rand(0, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 30)),
            ]);
        }
    }
}
