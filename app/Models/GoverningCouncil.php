<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoverningCouncil extends Model
{
    use HasFactory;
    // protected $table = 'nims_aboutus';
    protected $table;

    public function setTableName($tableName)
    {
        // dd($tableName);
        $this->table = $tableName;
    }

    public $timestamps = false;

    protected $fillable = [
            'type',           
            'governmentc',           
    ];
}
