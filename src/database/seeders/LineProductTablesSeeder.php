<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Line;
use App\Models\Product;
use App\Models\LineProduct;
use Illuminate\Support\Carbon;

class LineProductTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        LineProduct::truncate();

        foreach (LINE::all() as $line) {
            foreach (Product::all() as $product) {
                LineProduct::create([
                    'line_id' => $line->id,
                    'product_id' => $product->id,
                ]);
                break;
            }
        }
    }
}