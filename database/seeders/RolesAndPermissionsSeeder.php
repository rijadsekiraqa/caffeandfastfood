<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $permissions = [
            'show_users',
            'create_user',
            'view_user',
            'update_user',
            'delete_user',
            'admin_profile',
        ];

        foreach ($permissions as $permission) {
            SpatiePermission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Roles
        $adminRole = SpatieRole::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $staffRole = SpatieRole::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);

        // Assign Permissions to Roles
        $adminRole->givePermissionTo($permissions);
        $staffRole->givePermissionTo(['admin_profile']);
    }
}





