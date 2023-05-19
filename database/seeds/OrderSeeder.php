<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 1,
            'order_status' => 0,
            'ordered_at' => '2023-12-24 12:00.00',
            'estiimated_delivery_time' => '2023-12-24 13:30.00',
            'total_money' => 10000,
            'memo' => 'test',
            'address' => 'tokyo',
            'tel' => '12345',
            'tax' => 1000,
        ]);
    }
}
