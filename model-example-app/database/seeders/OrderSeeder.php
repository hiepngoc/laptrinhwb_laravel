<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\form;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vô hiệu hóa kiểm tra khóa ngoại để truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
     
        $users = User::all();
        $products = Product::all();
        $status = ['pending', 'completed', 'cancelled'];

        // Tạo 100 đơn hàng cho mỗi người dùng
        for ($i = 1; $i <= 100; $i++) {
            // Chọn ngẫu nhiên một người dùng
            $user = $users->random();
            // Kiểm tra nếu không có người dùng hoặc sản phẩm
            if ($users->isEmpty() || $products->isEmpty()) {
                throw new \Exception("Không có người dùng hoặc sản phẩm.");
            }
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ggbbbn' . $i,
                'total_amount' => rand(90000, 300000),
                'status' => $status[array_rand($status)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $orderProducts = $products->random(rand(1, 10)); //thêm 1 đến 10 sp
            foreach ($orderProducts as $product) {
                $order->products()->attach($product->id, [
                    'quantity' => rand(1, 5), // Số lượng ngẫu nhiên từ 1 đến 5
                    'price' => $product->price, // Giá sản phẩm
                    'created_at' => now(),
                ]);
            }
        }
    }
}
