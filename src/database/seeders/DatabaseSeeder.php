<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Schema::disableForeignKeyConstraints(); //外部キーチェックを無効にする

        $this->call([
            AdminTablesSeeder::class,
            UserTablesSeeder::class,
            LineTablesSeeder::class,
            ProductTablesSeeder::class,
            LineProductTablesSeeder::class,
            ProductVolumeTablesSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints(); //外部キーチェックを有効にする
    }
}
