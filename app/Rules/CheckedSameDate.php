<?php

namespace App\Rules;

use Closure;
use App\Models\Tender;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckedSameDate implements ValidationRule
{
    public $model_name;
    public $colomn_number;
    public $colomn_end_date;
    public $msg;

     /**
     * Create a new rule instance.
     *
     * @param mixed $parameter
     * @return void
     */
    public function __construct($model_name,$colomn_number,$colomn_end_date,$msg)
    {
        $this->colomn_number = $colomn_number;
        $this->colomn_end_date = $colomn_end_date;
        $this->model_name = $model_name;
        $this->msg = $msg;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // dd($this->colomn_number,$this->colomn_end_date,$this->model_name);
    
        $end_date = $value;
        $c_n = $this->colomn_number;
        $c_e_d = $this->colomn_end_date;
        $M_N = $this->model_name;
        $modelData = $M_N::where([$c_n=>request()->number])->first($c_e_d);
        date_default_timezone_set('Asia/Kolkata');
  
        $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $end_date)));
        $modelDataEndDate = date('Y-m-d', strtotime(str_replace('/', '-', $modelData->$c_e_d)));
        // dd($this->model_name,$end_date,$modelDataEndDate);
        if ($modelDataEndDate != $end_date) {
            $fail('End date of '.$this->msg.' are not same.Please correct the end date.');
        }
    }
}
