<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Product::truncate();
        Product::create([
            'name1' => 'GROUP1',
            'name2' => '製品1',
            'memo' => '製品1のメモ',
            'goal' => 3,
            'price' => 1000,
        ]);

        Product::create([
            'name1' => 'GROUP1',
            'name2' => '製品2',
            'memo' => '製品2のメモ',
            'goal' => 5,
            'price' => 2000,
        ]);

        Product::create([
            'name1' => 'GROUP2',
            'name2' => '製品1',
            'memo' => '製品3のメモ',
            'goal' => null,
            'price' => 3000,
        ]);

    }
}