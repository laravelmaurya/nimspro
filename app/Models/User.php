<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissionsTrait;
    // public $connection = 'pgsql';
    // protected $table = 'ahiscl.hivt_user_test_mst';

     // public $connection = 'pgsql';
    protected $table = 'nims_wp_user_login';
    protected $primaryKey = 'nims_wp_user_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nims_employe_code',
        'nims_wp_user_name',
        'nims_wp_user_email',
        'nims_wp_user_password',
        'nims_employe_mob_no',
        'e_email',
        'nims_wp_department_name',
        'nims_wp_user_type',
        'nims_wp_user_created_by',
        'nims_wp_user_created_on',
        'user',
        'nims_wp_user_status',
        'nims_wp_salt_random',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'nims_wp_user_password',
        'remember_token',
    ];

    public $timestamps = false;

    public function getAuthPassword()
    {
        return $this->nims_wp_user_password;
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    // protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed', ];

    public function departments() {
        return $this->hasMany(Department::class);
        // return $this->belongsToMany(Role::class, 'users_roles');
    }
}
