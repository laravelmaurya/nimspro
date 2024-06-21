<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'nims_notification';
    protected $primaryKey = 'notifi_id';
    public $timestamps = false;

    protected $fillable = [
        'nims_main_id',
        'nims_main',
        'notifi_archive',
        'type',        
        'notifi_title',
        'notifi_number',
        'notifi_desc',
        'notifi_start_date',
        'notifi_end_date',
        'notifi_submit_date',
        'entry_date',
        'notifi_docu',
        'notifi_docu_link1','notifi_docu_link2','notifi_docu_link3','notifi_docu_link4',
        'notifi_docu_link5','notifi_docu_link6','notifi_docu_link7','notifi_docu_link8',
        'notifi_docu_link9','notifi_docu_link10'   
            
    ];
}
