<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ManagePermission
{

    public function handle(Request $request, Closure $next, $Controller_name)
    {
        $user = Auth::user();
        if ($user->type == 'super_admin') {
            return $next($request);
        } elseif ($user->type == 'admin') {
            if ($user->user_roles) {
                foreach ($user->user_roles as $item) {
                    if ($Controller_name == $item->permission->controller) {
                        return $next($request);
                    }
                }
                return redirect()->back()->with('sessionMessage', 'You are not allowed to access this page');
            }
            return redirect()->route('admin.adminprofile');
        } else {
            return redirect()->route('admin.adminprofile');
        }

        abort(404);
    }
}
