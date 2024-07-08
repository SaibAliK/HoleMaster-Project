<?php

use Illuminate\Support\Facades\Auth;

function checkPermission($controller_name)
{
    $user = Auth::user();
    if ($user->type == 'super_admin') {
        return true;
    } elseif ($user->type == 'admin') {
        if ($user->user_roles) {
            foreach ($user->user_roles as $item) {
                if ($controller_name == $item->permission->controller) {
                    return true;
                }
            }
            return false;
        }
    } else {
        return false;
    }
}
