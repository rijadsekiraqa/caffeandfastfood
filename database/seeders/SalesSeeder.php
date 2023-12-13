<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Permissions
        $permissions = [
            'show_sales',
            'create_sale',
            'view_produc',
            'update_product',
            'delete_product',
        ];

        foreach ($permissions as $permission) {
            SpatiePermission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Roles
        $adminRole = SpatieRole::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $staffRole = SpatieRole::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);

        // Assign Permissions to Roles
        $adminRole->givePermissionTo($permissions);
//        $staffRole->givePermissionTo(['admin_profile']);
    }
}
