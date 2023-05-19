<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            
            'name' => '山田',
            'email' => 'kaze@kaze',
            'password' => Hash::make('12134abcd'),
            'address' => '世田谷区',
            'tel' => '03-111-222',
            
        ]);
        
        User::create([
            'name' => 'トムクルース',
            'email' => 'test@test',
            'password' => Hash::make('5678abcd'),
            'address' => '渋谷区',
            'tel' => '03-222-333',
            
        ]);
        
        //
    }
}
