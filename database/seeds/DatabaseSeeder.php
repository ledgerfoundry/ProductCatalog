<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Database\Eloquent\Model;
//use database\seeds\UserTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Model::unguard();
        User::create([
            'name' => 'Administrator',
            'email' => 'test@gmail.com',
            'role' => 'Admin',
            'password' => bcrypt('test123')
        ]);
        Model::reguard();
    }
}
