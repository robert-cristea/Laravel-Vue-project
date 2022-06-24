<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'test@test.com',
            'name' => 'Test Test',
            'role' => 'admin',
            'password' => bcrypt('1234')
        ]);
    }
}
