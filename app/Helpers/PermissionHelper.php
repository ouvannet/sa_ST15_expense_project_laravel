<?php

use Illuminate\Support\Facades\Session;

if (!function_exists('user_permission')) {
    /**
     * Check if the user has a specific permission.
     *
     * @param string $permission
     * @return bool
     */
    function user_permission(string $permission)
    {
        $permissions = Session::get('user_permissions', []);
        return in_array($permission, $permissions);
    }
}
