<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];
    public function permissions()    {  
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_nims_wp_role_id', 'permission_nims_wp_permission_id');
        // return $this->belongsToMany(Permission::class, 'roles_permissions');    
    }   
     
    public function users()    {                
        return $this->belongsToMany(User::class, 'users_roles', 'role_nims_wp_role_id', 'user_nims_wp_user_id');
        // return $this->belongsToMany(User::class, 'users_roles');    
    }
}
