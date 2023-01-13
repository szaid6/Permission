<?php

namespace Sz6\Permission\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Sz6\Permission\Models\Permission;
use Sz6\Permission\Models\Role;
use Illuminate\Support\Str;
use Sz6\Permission\Models\Rolepermission;
use Sz6\Permission\Models\Userpermission;

class PermissionController extends Controller
{

    // User Controller
    public function updateUserRole(Request $request)
    {
        $user = User::find($request->hiddenId);
        $user->roleId = $request->role;
        $user->update();

        // delete all previous permissions
        Userpermission::where('userId', $request->hiddenId)->delete();

        $rolePermission = Rolepermission::where('roleId', $request->role)->get();

        foreach ($rolePermission as $rp) {
            $userPermission = new Userpermission;
            $userPermission->userId = $user->id;
            $userPermission->permission = $rp->permission;
            $userPermission->save();
        }

        $this->storeLog('Update', 'updateUserRole', $user);
        Session()->flash('alert-success', "User Role Updated Successfully");
        return redirect()->back();
    }

    public function showUserPermissions($username)
    {
        $user = User::where('username', $username)->first();
        $userPermissions = Userpermission::where('userId', $user->id)->pluck('permission')->toArray();
        $permissions = Permission::all();
        return view('admin.userPermission', compact('user', 'permissions', 'userPermissions'));
    }

    public function assignUserPermissions(Request $request)
    {
        $user = User::find($request->hiddenId);
        Userpermission::where('userId', $user->id)->delete();

        if ($request->permissions) {
            foreach ($request->permissions as $permission) {
                $userPermission = new Userpermission;
                $userPermission->userId = $user->id;
                $userPermission->permission = $permission;
                $userPermission->save();
            }
        }

        $this->storeLog('Update', 'assignUserPermissions', $user);
        Session()->flash('alert-success', "User Permissions Updated Successfully");
        return redirect('/user');
    }

    //Roles Controller
    public function indexRole()
    {
        $roles = Role::all();
        $userRoleCount = User::select('roleId', DB::raw('count(*) as total'))->groupBy('roleId')->get();
        $users = User::where('deleteId', 0)->select('id', 'employeeName', 'roleId')->get();
        return view('admin.role', compact('roles', 'userRoleCount', 'users'));
    }

    public function showAddRole()
    {
        $permissions = Permission::all();
        return view('admin.roleAdd', compact('permissions'));
    }

    public function viewRole($id)
    {
        $role = Role::where('id', $id)->first();
        $users = User::where('roleId', $id)->where('deleteId', 0)->get();
        return view('admin.roleView', compact('role', 'users'));
    }

    public function addRole(Request $request)
    {
        $role = new Role;
        $role->name = $request->name;
        $role->slug = Str::slug($request->name, '-');
        $role->attendanceFlag = $request->attendanceFlag;
        $role->save();

        if ($request->permissions) {
            foreach ($request->permissions as $permission) {
                $rolePermission = new Rolepermission();
                $rolePermission->roleId = Str::slug($request->name, '-');
                $rolePermission->permission = $permission;
                $rolePermission->save();
            }
        }

        return redirect('/role');
    }

    public function showUpdateRole($name)
    {
        $role = Role::where('slug', $name)->first();
        $permissions = Permission::all();
        $rolePermissions = Rolepermission::where('roleId', $name)->pluck('permission')->toArray();
        // return $rolePermissions;
        return view('admin.roleUpdate', compact('role', 'permissions', 'rolePermissions'));
    }

    public function updateRole(Request $request)
    {

        $role = Role::find($request->hiddenId);
        $role->attendanceFlag = $request->attendanceFlag;
        $role->update();

        Rolepermission::where('roleId', $request->hiddenId)->delete();

        if ($request->permissions) {
            foreach ($request->permissions as $permission) {
                $rolePermission = new Rolepermission;
                $rolePermission->roleId = $role->slug;
                $rolePermission->permission = $permission;
                $rolePermission->save();
            }
        }

        $this->storeLog('Update', 'updateRole', $role);
        return redirect('/role');
    }

    // Permissions Controller
    public function indexPermission()
    {
        $permissions = Permission::all();
        return view('admin.permission', compact('permissions'));
    }

    public function addPermission(Request $request)
    {
        $permission = new Permission;
        $permission->panel = $request->panel;
        $permission->tab = $request->name;
        $slug = Str::slug($request->panel . '_' . $request->name);
        $permission->slug = $slug;
        $permission->save();
        return redirect()->back();
    }
}
