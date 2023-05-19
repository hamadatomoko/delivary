<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'hamada',
            'email' => 'test@test',
            'password' => Hash::make('123456'),
            
        ]);
        //
    }
}
