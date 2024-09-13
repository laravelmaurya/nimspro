<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporary extends Model
{
    use HasFactory;

    protected $table= 'temporaries';
    public $timestamps = false;
    protected $fillable = [
        'te','c','c1','c2','c3','c4', 'c5','c6', 'c7','c8','c9','c10',       
        'title','title1','title2','title3','title4','title5','title6','title7','title8','title9','title10',       
        
];
}
