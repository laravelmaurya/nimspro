<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DataTamperingCheck implements ValidationRule
{
    protected $base64EncodedValue;
    protected $decodedValue;

    public function __construct($base64EncodedValue)
    {
        $this->base64EncodedValue = $base64EncodedValue;
        $this->decodedValue = base64_decode($base64EncodedValue);
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         if(stripos($value, $this->decodedValue) == false){
            $fail('The :attribute field has been tampered with.');
         }
    }
}
