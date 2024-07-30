<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;
    protected $table = 'nims_wp_admissions';
    protected $primaryKey = 'nims_admissions_id';
    public $timestamps = false;

    protected $fillable = [
            'nims_add_id',
            'nims_main',
            'nims_admissions_archive',
            'nims_admissions_title',
            'nims_admissions_number',       
            'nims_admissions_desc',
            'nims_admissions_start_date',
            'nims_admissions_end_date',          
            'nims_admissions_submit_date',
            'entry_date',
            'nims_wp_log_ip',
            'nims_wp_user_id',
            'nims_admissions_doc',           
            'nims_wp_admission_link1','nims_wp_admission_link2','nims_wp_admission_link3','nims_wp_admission_link4',
            'nims_wp_admission_link5','nims_wp_admission_link6','nims_wp_admission_link7','nims_wp_admission_link8',
            'nims_wp_admission_link9','nims_wp_admission_link10'
    ];
}
