<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = 'nims_wp_department';
    protected $primaryKey = 'nims_wp_department_id';
    public $timestamps = false;
}
