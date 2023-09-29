<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Line;
use Illuminate\Support\Carbon;

class LineTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        Line::truncate();
        Line::create([
            'name' => 'LINE1',
            'memo' => 'LINE1のメモ',
        ]);

        Line::create([
            'name' => 'LINE2',
            'memo' => 'LINE2のメモ',
        ]);

        Line::create([
            'name' => 'LINE3',
            'memo' => 'LINE3のメモ',
        ]);

    }
}