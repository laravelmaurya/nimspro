<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;
    protected $table = 'nims_wp_examination';
    protected $primaryKey = 'nims_examination_id';
    public $timestamps = false;

    protected $fillable = [
            'nims_add_id',
            'nims_main',
            'nims_examination_archive',
            'nims_examination_title',
            'nims_examination_number',       
            'nims_examination_desc',
            'nims_examination_start_date',
            'nims_examination_end_date',          
            'nims_examination_submit_date',
            'entry_date',
            'nims_wp_log_ip',
            'nims_wp_user_id',
            'nims_examination_doc',           
            'nims_wp_examination_link1','nims_wp_examination_link2','nims_wp_examination_link3','nims_wp_examination_link4',
            'nims_wp_examination_link5','nims_wp_examination_link6','nims_wp_examination_link7','nims_wp_examination_link8',
            'nims_wp_examination_link9','nims_wp_examination_link10'
    ];
    
}
