<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

trait PermissionTrait
{

    public function hasPermissions(string $permissionName, $user): bool
    {

        $data = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('role_has_permissions', 'role_user.role_id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            ->select('permissions.name')
            ->where('users.id', '=', $user->getAuthIdentifier())
            ->get();

        foreach ($data->getIterator() as $item) {
            if ($item->name == $permissionName) {
                return true;
            }
        }
        return false;

    }


}
