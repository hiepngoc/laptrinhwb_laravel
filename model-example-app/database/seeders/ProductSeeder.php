<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        DB::table('order_product')->truncate(); // Xóa dữ liệu bảng pivot
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        //tạo dữ liệu mẫu
        for($i=1;$i<=50;$i++){
            Product::create([
                'name' => 'Product '.$i,
                'description' => 'Description '.$i,
                'price' => rand(10000, 100000),
                'quantity' => rand(1, 100),
                'status' => 'active',
            ]);
        }
    }
}
