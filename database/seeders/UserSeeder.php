<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new User();
        $user->name = "Phua CHua Kang";
        $user->email = "phua@asd12345.com";
        $user->password = "password1";
        $user->save();
    }
}
