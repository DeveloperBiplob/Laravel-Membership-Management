<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'designation_id' => 1,
            'name' => Str::random(5),
            'userName' => Str::random(5),
            'created_by' => 1,
            'updated_by' => 1,
            'phone' => rand(1, 10),
            'email' => Str::random(5) . '@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
