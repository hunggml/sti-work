<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Work;

$factory->define(Work::class, function (Faker $faker) {
    return [
        'user_id' => Str::random(20),
        'user_name' => Str::random(100),
        'detail' => Str::random(10000),
        'status' => "Chưa hoàn thành",
        'start_date' => new DateTime(),
        'end_date' => new DateTime(),
        'check' => 0,
        'progress' => 0,
        'hidden' => 0,
    ];
});
