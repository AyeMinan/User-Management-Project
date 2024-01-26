<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'username',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function hasRoleViewPermission()
    {
        return $this->hasViewPermissions('role', ['view']);
    }

    public function hasViewPermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasRoleCreatePermission()
    {
        return $this->hasCreatePermissions('role', ['create']);
    }

    public function hasCreatePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasRoleUpdatePermission()
    {
        return $this->hasUpdatePermissions('role', ['update']);
    }

    public function hasUpdatePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasRoleDeletePermission()
    {
        return $this->hasDeletePermissions('role', ['delete']);
    }

    public function hasDeletePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasUserViewPermission()
    {
        return $this->hasUserViewPermissions('user', ['view']);
    }

    public function hasUserViewPermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasUserCreatePermission()
    {
        return $this->hasUserCreatePermissions('user', ['create']);
    }

    public function hasUserCreatePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasUserUpdatePermission()
    {
        return $this->hasUserUpdatePermissions('user', ['update']);
    }

    public function hasUserUpdatePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasUserDeletePermission()
    {
        return $this->hasUserDeletePermissions('user', ['delete']);
    }

    public function hasUserDeletePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasProductViewPermission()
    {
        return $this->hasProductViewPermissions('product', ['view']);
    }

    public function hasProductViewPermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasProductCreatePermission()
    {
        return $this->hasProductCreatePermissions('product', ['create']);
    }

    public function hasProductCreatePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasProductUpdatePermission()
    {
        return $this->hasProductUpdatePermissions('product', ['update']);
    }

    public function hasProductUpdatePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }

    public function hasProductDeletePermission()
    {
        return $this->hasProductDeletePermissions('product', ['delete']);
    }

    public function hasProductDeletePermissions($feature, $permissions)
    {
        $matchingPermissionsCount = $this->role->permissions
            ->whereIn('feature_id', Feature::where('name', $feature)->pluck('id'))
            ->whereIn('name', $permissions)
            ->count();

        return $matchingPermissionsCount === count($permissions);
    }



}
