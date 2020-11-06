<?php

use Illuminate\Database\Seeder;
//Add
use App\Other\UserStatus;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Defaults
        $user_statuses = [
            ['id'=>1, 'name'=>'Active'],
            ['id'=>2, 'name'=>'Dormant'],
            ['id'=>3, 'name'=>'Blocked'],
        ];
        UserStatus::insert($user_statuses);    

    }
}
