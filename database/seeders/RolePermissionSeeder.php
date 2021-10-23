<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supperAdminRole = User::createRole('Supper Admin');
        $memberRole = User::createRole('Member');

        // Permissions Group Wise
        $permissionGroups = [
            'dashboard' => [
                'dashboard.view',
                'dashboard.member_statistice'
            ],

            'user' => [
                'user.list',
                'user.create',
                'user.edit',
                'user.show',
                'user.delete'
            ],

            'member' => [
                'member.list',
                'member.create',
                'member.edit',
                'member.show',
                'member.delete'
            ],

            'monthly_installment' => [
                'monthly_installment.list',
                'monthly_installment.create',
                'monthly_installment.edit',
                'monthly_installment.show',
                'monthly_installment.delete'
            ],

            'fixed_installment' => [
                'fixed_installment.list',
                'fixed_installment.create',
                'fixed_installment.edit',
                'fixed_installment.show',
                'fixed_installment.delete'
            ],

            'collection' => [
                'collection.list',
                'collection.create',
                'collection.edit',
                'collection.show',
                'collection.delete'
            ],

            'report' => [
                'report.monthly_Collection',
                'report.fixed_collection'
            ],
        ];

        $memberPermissions = [
            'dashboard.view',
            'profile.edit',
            'collection.view'
        ];

        // Insert the permission and assign it to a role
        foreach($permissionGroups as $permissionGroupKey => $permissions){
            foreach($permissions as $permissionName){
                $permission = Permission::create([
                    // 'guard_name' => 'sunctum',
                    'group_name' => $permissionGroupKey,
                    'name' => $permissionName
                ]);

                $supperAdminRole-> givePermissionTo($permission);
                $permission->assignRole($supperAdminRole);

                if(in_array($permissionName, $memberPermissions)){
                    $memberRole-> givePermissionTo($permission);
                    $permission->assignRole($memberRole);
                }
            }
        }
    }
}
