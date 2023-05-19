<?php

use Illuminate\Database\Seeder;
use App\Category;

class categoryseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => '寿司',
            
        ]);
        Category::create([
            'name' => '丼もの',
            
        ]);
        Category::create([
            'name' => '焼物',
            
        ]);
        Category::create([
            'name' => '天ぷら',
            
        ]);
        Category::create([
            'name' => '茶碗蒸し',
            
        ]);
    }
}
