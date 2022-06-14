<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class ValidateGTF implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        // 
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        $size = filesize($value);
        $extension = Str::endsWith(strtoupper($value->getClientOriginalName()),["GTF","GFF","GTF.GZ","GFF.GZ"]);

        if (!$extension){
            $this->error_message = "Please submit a valid GTF/GFF file.";
            return false;
        }
        elseif ($size === 0){
            $this->error_message = "Please submit a GTF file that is not empty.";
            return false;
        }
        else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error_message;
    }
}
