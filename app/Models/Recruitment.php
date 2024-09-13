<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;
    protected $table = 'nims_wp_recruitment';
    protected $primaryKey = 'nims_recruitment_id';
    public $timestamps = false;

    protected $fillable = [
            'nims_add_id',
            'nims_main',
            'nims_applyonline',
            'nims_recruitment_archive',
            'nims_recruitment_title',
            'nims_recruitment_number',       
            'nims_recruitment_desc',
            'nims_recruitment_start_date',
            'nims_recruitment_end_date',          
            'nims_recruitment_submit_date',
            'entry_date',
            'nims_wp_log_ip',
            'nims_wp_user_id',
            'nims_recruitment_doc',           
            'nims_wp_recruitment_link1','nims_wp_recruitment_link2','nims_wp_recruitment_link3','nims_wp_recruitment_link4',
            'nims_wp_recruitment_link5','nims_wp_recruitment_link6','nims_wp_recruitment_link7','nims_wp_recruitment_link8',
            'nims_wp_recruitment_link9','nims_wp_recruitment_link10'
    ];
}
