<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NoDoubleExt implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
   
        // Get the original file name
        $fileName = $value->getClientOriginalName();
        // DD($fileName);
        // Check for special characters
        if (preg_match('/[^A-Za-z0-9.\-_ ]/', $fileName)) {
            $fail('Attachment contain not suported special characters, multiple dots, or double extensions.');
        }

        // Check for multiple dots and double extensions
        $parts = explode('.', $fileName);
        if (count($parts) > 2) {
            $fail('Attachment contain  not suported special characters, multiple dots, or double extensions.');
        }

        if (strlen($fileName) > 100) {
            $fail('Attachment name not suported long name');
        }
    }

   
    
}
