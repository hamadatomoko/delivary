<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(categoryseeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
