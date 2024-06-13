<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-create',            
            'user-list',            
            'user-edit',            
            'user-show',            
            'role-create',
            'role-list',
            'role-edit', 
            'role-show',            
            'permission-create',
            'permission-list',
            'permission-edit',
            'permission-show',
            
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
