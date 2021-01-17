<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Apple',
            'price' => 20,
            'image_url' => 'http://127.0.0.1:8000/storage/products/apple01.jpg'
        ]);

        DB::table('products')->insert([
            'name' => 'Orange',
            'price' => 30,
            'image_url' => 'http://127.0.0.1:8000/storage/products/orange01.jpg'
        ]);

    }
}
