<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed 如沒有加--class=,預設是DatabaseSeeder
        //所以通常會在DatabaseSeeder裡註冊
        $this->call([
            ProductSeeder::class,
        ]);
    }
}
