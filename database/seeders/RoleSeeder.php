<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run()
    {
        DB::table("roles")->insertOrIgnore([
            ["role" => "organizer"],
            ["role" => "guest"],
        ]);
    }
}
