<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;
    protected $table = 'nims_wp_tenders';
    protected $primaryKey = 'nims_wp_tender_id';
    public $timestamps = false;

    protected $fillable = [
            'nims_add_id',
            'nims_maintender',
            'nims_wp_tender_archive',
            'nims_wp_tender_title',
            'nims_wp_tender_number',       
            'nims_wp_tender_description',
            'nims_wp_tender_start_date',
            'nims_wp_tender_end_date',          
            'nims_wp_tender_submit_date',
            'entry_date',
            'nims_wp_tender_doc',           
            'nims_wp_tender_link1','nims_wp_tender_link2','nims_wp_tender_link3','nims_wp_tender_link4',
            'nims_wp_tender_link5','nims_wp_tender_link6','nims_wp_tender_link7','nims_wp_tender_link8',
            'nims_wp_tender_link9','nims_wp_tender_link10'
    ];
}
