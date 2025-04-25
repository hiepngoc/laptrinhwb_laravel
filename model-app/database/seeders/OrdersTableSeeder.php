<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\OrderItem; // 👈 chính là bảng "sản phẩm" bạn nói
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('orders')->truncate();
        DB::table('order_items')->truncate(); // 👈 giả sử đây là bảng trung gian (tạo riêng)
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $users = User::all();
        $products = OrderItem::all(); // sản phẩm

        if ($users->count() > 0 && $products->count() > 0) {
            for ($i = 0; $i < 100; $i++) {
                $randomUser = $users->random();

                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => $randomUser->id,
                    'total_amount' => 0,
                    'address' => 'Địa chỉ ' . $i . ', ' . $randomUser->name . "'s Address",
                    'created_at' => Carbon::now()->subDays(rand(0, 30)),
                    'updated_at' => Carbon::now()->subDays(rand(0, 30)),
                ]);

                $total = 0;
                $numItems = rand(1, 3);
                $randomProducts = $products->random($numItems);

                foreach ($randomProducts as $product) {
                    $quantity = rand(1, 5);
                    $price = $product->price;
                    $total += $price * $quantity;

                    DB::table('order_items_detail')->insert([ // 👈 bảng chứa thông tin từng món trong đơn hàng
                        'order_id' => $orderId,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                DB::table('orders')->where('id', $orderId)->update([
                    'total_amount' => $total,
                ]);
            }
        } else {
            $this->command->warn('Bạn cần seed User và OrderItem (product) trước khi seed Orders.');
        }
    }
}
