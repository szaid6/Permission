<?php

namespace Sz6\Permission\Http\Middleware;

use Closure;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sz6\Permission\Models\Userpermission;

class permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $viewPermissions = Userpermission::where('userId', Auth::user()->id)->where('permission', 'like', '%view%')->pluck('permission')->toArray();
        $addPermissions = Userpermission::where('userId', Auth::user()->id)->where('permission', 'like', '%add%')->pluck('permission')->toArray();
        $updatePermissions = Userpermission::where('userId', Auth::user()->id)->where('permission', 'like', '%update%')->pluck('permission')->toArray();
        $deletePermissions = Userpermission::where('userId', Auth::user()->id)->where('permission', 'like', '%delete%')->pluck('permission')->toArray();

        // $roleList = Role::pluck('slug')->toArray();

        // $roleAttendancePermission = Role::where('slug', Auth::user()->roleId)->pluck('attendanceFlag')->toArray();

        config(
            [
                'viewPermissions' => $viewPermissions,
                'addPermissions' => $addPermissions,
                'updatePermissions' => $updatePermissions,
                'deletePermissions' => $deletePermissions,
                // 'roleAttendancePermission' => $roleAttendancePermission,
                // 'roleList' => $roleList
            ]);
        $d = $request->route()->getPrefix();
        $d = substr($d, 1);
        $urlRedirects = Userpermission::where('userId', Auth::user()->id)->where('permission', 'like', '%view%')->where('permission', 'like', '%-' . $d . '%')->pluck('permission')->toArray();
        if (count($urlRedirects) > 0 || $d == 'profile' || $d == 'permission' || $d == 'dashboard') {
            return $next($request);
        } else {
            return abort(403);
        }
        // return $next($request);

    }
}
