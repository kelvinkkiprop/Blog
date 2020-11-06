<?php

use Illuminate\Database\Seeder;
//Add
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Defaults
        $users = [
            ['name'=>'Super Administrator', 'email'=>'administrator@blog.com', 'super'=>'Y', 'type'=>1, 'password'=>Hash::make('administrator'),
            'email_verified_at' => date('Y-m-d H:i:s'), 'remember_token'=>Str::random(50), 'created_at'=>date('Y-m-d H:i:s'), 'updated_at'=>date('Y-m-d H:i:s')]
        ];
        User::insert($users);
    }
}
