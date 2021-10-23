<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
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
        $user = new User();
        $user->designation_id = 1;
        $user->name =  'Biplob Jabery';
        $user->userName =  'biplob_jabery';
        $user->created_by = 1;
        $user->updated_by =  1;
        $user->phone =  '01643381009';
        $user->email =  'biplobjabery@gmail.com';
        $user->password =  bcrypt('password');
        $user->save();
        $user->assignRole('Supper Admin');


        $user = new User();
        $user->designation_id = 2;
        $user->name =  'Member';
        $user->userName =  'member';
        $user->created_by = 2;
        $user->updated_by =  2;
        $user->phone =  '01643381001';
        $user->email =  'member@gmail.com';
        $user->password =  bcrypt('password');
        $user->save();
        $user->assignRole('Member');

        # Grab ta use ID and create a member
        Member::create([
            'user_id' => $user->id,
            'created_by' => 1,
            'custom_id' => 200,
            'nid' => '3215487515',
            'created_at' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
    }
}
