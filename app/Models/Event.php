<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    //   public $connection = 'pgsql';
    protected $table = 'nims_wp_event';
    protected $primaryKey = 'nims_wp_event_id';
    public $timestamps = false;

    protected $fillable = [
            'nims_add_id',
            'nims_wp_event_archive',
            'nims_wp_event_title',       
            'nims_wp_event_desc',
            'nims_wp_event_start_date',
            'nims_wp_event_end_date',          
            'nims_wp_event_submit_date',
            'entry_date',
            'nims_wp_log_ip',
            'nims_wp_user_id',
            'nims_wp_event_department',
            'nims_wp_event_doc',           
            'nims_wp_notify_status',           
            'nims_wp_event_link1','nims_wp_event_link2','nims_wp_event_link3','nims_wp_event_link4'
    ];
}
