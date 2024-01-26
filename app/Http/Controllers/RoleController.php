<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function show(){
        return view("main.role", [
            'roles' => Role::all()
        ]);
    }

    public function create(){
        $featureUser = Feature::where('name', 'user')->first();
        $featureRole = Feature::where('name', 'role')->first();
        $featureProduct = Feature::where('name', 'product')->first();

        $userPermission = Permission::where('feature_id', $featureUser->id)->get();
        $rolePermission = Permission::where('feature_id', $featureRole->id)->get();
        $productPermission = Permission::where('feature_id', $featureProduct->id)->get();
        return view("role.create", [
            'feature' => [
                'user' => $featureUser,
                'role' => $featureRole,
                'product' => $featureProduct
            ],
            "permissions" => [
                'userPermission' => $userPermission,
                'rolePermission' => $rolePermission,
                'productPermission' => $productPermission
            ],

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);


        $role = Role::create([
            'name' => $request->input('roleName'),
        ]);


        if ($request->has('permissions')) {
            $selectedPermissions = $request->input('permissions');
            $permissions = Permission::whereIn('name', $selectedPermissions)->get();
            $role->permissions()->attach($permissions);
        }



        return redirect('/role')->with('success', 'Role created successfully.');
    }

    public function delete(Role $role){


        $users = User::where('role_id', $role->id)->get();


        if ($users->isEmpty()) {
            $role->permissions()->detach();
            $role->delete();
            return redirect('/role')->with('message', 'Role has been successfully deleted');
        } else {
            session()->flash('fail_message', 'This role is associated with one or more users. You need to delete those users first or assign them to a different role.');
            return redirect('/role');
        }
    }

    public function edit(Role $role){

        $featureUser = Feature::where('name', 'user')->first();
        $featureRole = Feature::where('name', 'role')->first();
        $featureProduct = Feature::where('name', 'product')->first();
        $userPermission = Permission::where('feature_id', $featureUser->id)->get();
        $rolePermission = Permission::where('feature_id', $featureRole->id)->get();
        $productPermission = Permission::where('feature_id', $featureProduct->id)->get();
        return view('role.edit', [
            'role' => $role->where('id', $role->id)->first(),
            'feature' => [
                'user' => $featureUser,
                'role' => $featureRole,
                'product' => $featureProduct
            ],
            "permissions" => [
                'userPermission' => $userPermission,
                'rolePermission' => $rolePermission,
                'productPermission' => $productPermission
            ]
        ]);

    }

    public function update(Role $role, Request $request)
    {
        $request->validate([
            'roleName' => 'required|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        try {
            $role->update([
                'name' => $request->input('roleName'),
            ]);

            $permissions = $request->input('permissions');

            if (!is_null($permissions)) {
                $permissions = Permission::whereIn('name', $permissions)->pluck('id');
                $role->permissions()->sync($permissions);
            } else {
                // If no permissions are selected, detach all existing permissions
                $role->permissions()->detach();
            }

            return redirect('/role')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {
            return redirect('/role')->with('error', 'An error occurred while updating the role.');
        }
    }


}
