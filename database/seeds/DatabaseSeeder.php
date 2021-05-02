<?php

use Illuminate\Database\Seeder;
use App\Work;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        // $this->call(UserSeeder::class);
        // $this->call(WorkSedder::class);
        DB::table('works')->insert([
            'user_id' => Str::random(20),
            'user_name' => Str::random(100),
            'detail' => Str::random(10000),
            'status' => "Chưa hoàn thành",
            'start_date' => new DateTime(),
            'end_date' => new DateTime(),
            'check' => 0,
            'progress' => 0,
            'hidden' => 0,
        ]);
    }
}
