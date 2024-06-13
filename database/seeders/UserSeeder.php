<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    
        $users = [
            [
                'nims_employe_code' => 'E12345',
                'nims_wp_user_name' => 'Admin User',
                'nims_wp_user_password' => Hash::make('12345678'),
                'nims_wp_user_email' => 'admin@app.com',
                'nims_wp_department_name' => 'Admin Department',
                'nims_wp_user_type' => 'admin',
                'nims_wp_user_access' => 1,
                'nims_wp_user_login_emp_id' => 1,
                'nims_wp_user_created_by' => 'system',
                'nims_wp_user_created_on' => now(),
                'nims_employe_mob_no' => '1234567890',
                'e_email' => 'admin_personal@app.com',
                'nims_wp_user_status' => 'active',
                'user' => 'admin',
                'nimswp_speciality_clinic' => 0,
                'nimswp_dept_name' => 'Admin Department',
                'nimswp_password_change_status' => 0,
                'is_first_login' => 0,
                'nims_wp_salt_random' => 'random_salt_string',
            ],
            [
                'nims_employe_code' => 'E12346',
                'nims_wp_user_name' => 'Editor User',
                'nims_wp_user_password' => Hash::make('12345678'),
                'nims_wp_user_email' => 'user@app.com',
                'nims_wp_department_name' => 'Editorial Department',
                'nims_wp_user_type' => 'editor',
                'nims_wp_user_access' => 1,
                'nims_wp_user_login_emp_id' => 2,
                'nims_wp_user_created_by' => 'system',
                'nims_wp_user_created_on' => now(),
                'nims_employe_mob_no' => '1234567891',
                'e_email' => 'editor_personal@app.com',
                'nims_wp_user_status' => 'active',
                'user' => 'editor',
                'nimswp_speciality_clinic' => 0,
                'nimswp_dept_name' => 'Editorial Department',
                'nimswp_password_change_status' => 0,
                'is_first_login' => 0,
                'nims_wp_salt_random' => 'random_salt_string',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            
            // Assign roles to users
            if ($user->nims_wp_user_type == 'admin') {
                $role = Role::where('name', 'admin')->first();
                $user->roles()->attach($role);
            } elseif ($user->nims_wp_user_type == 'editor') {
                $role = Role::where('name', 'editor')->first();
                $user->roles()->attach($role);
            }
        }
    }
}
