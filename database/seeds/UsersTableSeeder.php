<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'username'=>'testman',
            'mail'=>'dummymail',
            'password'=>hash::make('pass'),
            'bio'=>'tester'
        ]);
    }
}
