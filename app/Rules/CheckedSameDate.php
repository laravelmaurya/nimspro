<?php

namespace App\Rules;

use Closure;
use App\Models\Tender;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckedSameDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $end_date = $value;
        $tender = Tender::where(['nims_wp_tender_number'=>request()->number])->first('nims_wp_tender_end_date');
        date_default_timezone_set('Asia/Kolkata');
        // $end_date = date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $end_date)));
        // $nims_wp_tender_end_date = date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $tender->nims_wp_tender_end_date)));
        $end_date = date('Y-m-d', strtotime(str_replace('/', '-', $end_date)));
        $nims_wp_tender_end_date = date('Y-m-d', strtotime(str_replace('/', '-', $tender->nims_wp_tender_end_date)));
        // dd($end_date,$nims_wp_tender_end_date);
        if ($nims_wp_tender_end_date != $end_date) {
            $fail('End date of MainTender & Corrigendum are not same.Please correct the end date.');
        }
    }
}
