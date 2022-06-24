<?php

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
        $role = new App\Role();
        $role->name = 'superadmin';
        $role->save();

        $user = new App\User();
        $user->name = 'Super Admin';
        $user->email = 'superadmin@test.com';
        $user->password = bcrypt('1234');
        $user->role = 'superadmin';
        $user->save();

        App\UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        $role = new App\Role();
        $role->name = 'admin';
        $role->save();

        $user = new App\User();
        $user->name = 'Test Admin';
        $user->email = 'admin@test.com';
        $user->password = bcrypt('1234');
        $user->role = 'admin';
        $user->save();

        App\UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        $role = new App\Role();
        $role->name = 'auditor';
        $role->save();

        $user = new App\User();
        $user->name = 'Test Auditor';
        $user->email = 'auditor@test.com';
        $user->password = bcrypt('1234');
        $user->role = 'auditor';
        $user->save();

        App\UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);

        $role = new App\Role();
        $role->name = 'concessionaire';
        $role->save();

        $user = new App\User();
        $user->name = 'Test Concessionaire';
        $user->email = 'concessionaire@test.com';
        $user->password = bcrypt('1234');
        $user->role = 'concessionaire';
        $user->save();

        App\UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }
}
