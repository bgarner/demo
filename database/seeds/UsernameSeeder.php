<?php

use Illuminate\Database\Seeder;
use App\Models\Auth\User\User;

class UsernameSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();    
        foreach ($users as $user) {
        	$username = $user->firstname . "." . $user->lastname;
        	$user->username = $username;
        	$user->save();
        }
    }
}
