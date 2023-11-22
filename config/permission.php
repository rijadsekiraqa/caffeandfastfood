<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Role and Permission Models
    |--------------------------------------------------------------------------
    |
    | This is the default role and permission model used by the application.
    |
    */

    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
        // 'model_has_permissions' => Some\Other\Model\HasPermissions::class,
        // 'model_has_roles' => Some\Other\Model\HasRoles::class,
        // 'role_has_permissions' => Some\Other\Model\RoleHasPermissions::class,
    ],

    // Other configuration options...

];
