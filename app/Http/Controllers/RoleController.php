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
        $this->authorize('show', Role::class);
        return view("main.role", [
            'roles' => Role::all()
        ]);
    }

    public function create(){
        $this->authorize('create', Role::class);
        $featureUser = Feature::where('name', 'user')->first();
        $featureRole = Feature::where('name', 'role')->first();

        $userPermission = Permission::where('feature_id', $featureUser->id)->get();
        $rolePermission = Permission::where('feature_id', $featureRole->id)->get();
        return view("role.create", [
            'feature' => [
                'user' => $featureUser,
                'role' => $featureRole
            ],
            "permissions" => [
                'userPermission' => $userPermission,
                'rolePermission' => $rolePermission
            ]
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('store', Role::class);
        $request->validate([
            'roleName' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);


        $role = Role::create([
            'name' => $request->input('roleName'),
        ]);


        $permissions = Permission::whereIn('name', $request->input('permissions'))->get();
        $role->permissions()->attach($permissions);



        return redirect('/role')->with('success', 'Role created successfully.');
    }

    public function delete(Role $role){
        $this->authorize('delete', $role);
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
        $this->authorize('edit', $role);

        $permissionName = $role->permissions()->first()->name;
        $featureUser = Feature::where('name', 'user')->first();
        $featureRole = Feature::where('name', 'role')->first();
        $userPermission = Permission::where('feature_id', $featureUser->id)->get();
        $rolePermission = Permission::where('feature_id', $featureRole->id)->get();
        return view('role.edit', [
            'role' => $role->where('id', $role->id)->first(),
            'feature' => [
                'user' => $featureUser,
                'role' => $featureRole
            ],
            "permissions" => [
                'userPermission' => $userPermission,
                'rolePermission' => $rolePermission
            ],
            'permissionName' => $permissionName
        ]);

    }

    public function update(Role $role, Request $request){
        $this->authorize('update', $role);
         $request->validate([
            'roleName' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name', // Assuming you have a "permissions" table
        ]);


        try {

            $role->update([
                'name' => $request->input('roleName'),
            ]);

            $permissions = Permission::whereIn('name', $request->input('permissions'))->pluck('id');
            $role->permissions()->sync($permissions);

            return redirect('/role')->with('success', 'Role updated successfully.');
        } catch (\Exception $e) {

            return redirect('/role')->with('error', 'An error occurred while updating the role.');
        }
    }

}
