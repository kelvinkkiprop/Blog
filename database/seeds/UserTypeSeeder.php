<?php

use Illuminate\Database\Seeder;
//Add
use App\Other\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Defaults
        $user_types = [
            ['id'=>1, 'name'=>'Admin'],
            ['id'=>2, 'name'=>'Normal'],
        ];
        UserType::insert($user_types);    
    }
}
