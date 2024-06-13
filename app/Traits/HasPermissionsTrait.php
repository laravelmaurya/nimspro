<?php
namespace App\Traits;
use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait{
    
    public function hasRole(...$roles) {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }
    public function roles() {
        return $this->belongsToMany(Role::class, 'users_roles', 'user_nims_wp_user_id', 'role_nims_wp_role_id');
        // return $this->belongsToMany(Role::class, 'users_roles');
    }
    public function permissions() {
        return $this->belongsToMany(Permission::class, 'users_permissions', 'user_nims_wp_user_id', 'permission_nims_wp_permission_id');
        // return $this->belongsToMany(Permission::class, 'users_permissions');
    }
    public function hasPermission($permission) {
        // dd($permission);
        return (bool)$this->permissions->where('name', $permission)->count();
    }
   
    
}
