<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DefaultAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [];

        foreach (array('admin', 'employee', 'user') as $rolename) {
            $role = new Role();
            $role->name = $rolename;
            $role->save();
            $roles += [$role->name => $role];
        }

        foreach ($roles as $key => $role) {
            $user = new User();
            $user->email = $key . '@test.sk';
            $user->password = Hash::make('nbusr123');
            $user->role_id = $role->id;
            $user->save();
        }

        // Test purposes (email sending)
        $user = new User();
        $user->email = 'frantisek.gic@gmail.com';
        $user->password = Hash::make('nbusr123');
        $user->role_id = 1;
        $user->save();
    }
}
