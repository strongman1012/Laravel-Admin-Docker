<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create a user.
        User::truncate();
        User::create([
            'name' => '従業員1',
            'email' => 'member1@test.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('member1@test.com'),
        ]);

        User::create([
            'name' => '従業員2',
            'email' => 'member2@test.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('member2@test.com'),
        ]);
    }
}