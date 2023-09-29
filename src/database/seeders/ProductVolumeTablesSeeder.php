<?php
namespace Database\Seeders;

use App\Enums\WorkType;
use Illuminate\Database\Seeder;
use App\Models\Line;
use App\Models\LineProduct;
use App\Models\ProductVolume;
use Illuminate\Support\Carbon;

class ProductVolumeTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        ProductVolume::truncate();

        for ($h=WorkType::WORK_START; $h < WorkType::WORK_END; $h++) {

            $line_id = rand(Line::get()->first()->id, Line::get()->last()->id);
            $product_id = rand(
                LineProduct::where('line_id', $line_id)->get()->first()->id, 
                LineProduct::where('line_id', $line_id)->get()->last()->id
            );

            ProductVolume::create([
                'line_id' => $line_id,
                'product_id' => $product_id,
                'work_start_at' => Carbon::createFromTime($h, 0, 0),
                'work_end_at' => Carbon::createFromTime($h, 59, 59),
                'count_worker' => 2,
                'count_volume' => rand(1, 5),
            ]);
        }
    }
}