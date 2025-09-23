<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsAndRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions =[
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            'roles.view',
            'roles.assign',
            'payments.view',
            'payments.create',
            'payments.refund',
            'reports.view',
            'settings.manage'
        ];

        foreach($permissions as $permission){
          Permission::firstOrCreate([
           'name'=>$permission
          ]);
        }

        // adding roles
        
        $superAdmin = Role::firstOrCreate(['name'=> 'super-admin']);
        $admin = Role::firstOrCreate(['name'=> 'admin']);
        $user = Role::firstOrCreate(['name'=> 'user']);


        // adding permissions

        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'users.view',
            'users.create',
            'users.edit',
            'roles.view',
            'roles.assign',
            'payments.view',
            'payments.create',
            'reports.view'
        ]);


        $user->givePermissionTo([
          'payments.view','payments.create'
        ]);

    

    }
}
