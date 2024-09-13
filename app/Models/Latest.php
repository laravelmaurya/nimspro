<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latest extends Model
{ 
    protected $table;
    protected $primaryKey = 'nims_wp_tender_id';
    public $timestamps = false;

    protected $fillable = [
            'nims_add_id',
            'nims_maintender',
            'nims_wp_tender_archive',       
            'nims_wp_tender_description',
            'nims_wp_tender_start_date',
            'nims_wp_tender_end_date',          
            'nims_wp_tender_submit_date',
            'entry_date',
            'nims_wp_log_ip',
            'nims_wp_user_id',
    ];
   
    public function setTableName($table_name)
    {
        // dd($table_name);
        $this->table = $table_name;
    }
    public function setTableColName($table_col_name)
    {
        // dd($table_name);
        $this->table_col_name = $table_col_name;
    }
}
