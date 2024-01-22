<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Feature;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $adminRole = \App\Models\Role::firstOrCreate(['name' => 'Administrator']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => $adminRole->id
        ]);


        Feature::firstOrCreate(['name' => 'user']);
        Feature::firstOrCreate(['name' => 'role']);

        $userFeature = Feature::where('name', 'user')->first();
        $roleFeature = Feature::where('name', 'role')->first();

        Permission::firstOrCreate(['name' => 'view', 'feature_id' => $userFeature->id]);
        Permission::firstOrCreate(['name' => 'create', 'feature_id' => $userFeature->id]);
        Permission::firstOrCreate(['name' => 'update', 'feature_id' => $userFeature->id]);
        Permission::firstOrCreate(['name' => 'delete', 'feature_id' => $userFeature->id]);

        Permission::firstOrCreate(['name' => 'view', 'feature_id' => $roleFeature->id]);
        Permission::firstOrCreate(['name' => 'create', 'feature_id' => $roleFeature->id]);
        Permission::firstOrCreate(['name' => 'update', 'feature_id' => $roleFeature->id]);
        Permission::firstOrCreate(['name' => 'delete', 'feature_id' => $roleFeature->id]);

        $adminPermissions = Permission::all();

        foreach($adminPermissions as $adminPermission){
            RolePermission::firstOrCreate(['role_id' => $user->role_id, 'permission_id' => $adminPermission->id]);
        }



    }
}
