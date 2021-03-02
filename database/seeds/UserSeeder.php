<?php

use App\User;
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
        User::create([
            "name" => "admin",
            "password" => bcrypt("admin"),
            "email" => "admin@google.com",
            "role"=>"Admin",
            "gender"=>"Female",
            "address"=>"jalan jalan",
            "DOB"=>"20-02-1999"
        ]);
        User::create([
            "name" => "member",
            "password" => bcrypt("member"),
            "email" => "member@google.com",
            "role"=>"Member",
            "gender"=>"Male",
            "address"=>"jalan jalan",
            "DOB"=>"20-02-1999"
        ]);
    }
}
