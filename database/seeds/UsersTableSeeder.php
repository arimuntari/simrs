<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
         DB::table('users')->insert([
            'name' => 'Administrator',
            'username' =>'admin',
            'password' => '123',
            'type' => '1',
        ]);
    }
}
