<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;


class ValidateBED implements Rule
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
        $extension = Str::endsWith(strtoupper($value->getClientOriginalName()),["BED"]);
        $size = filesize($value);

        if (!$extension){
            $this->error_message = "Please submit a valid BED file in $attribute.";
            return false;
        }
        elseif ($size === 0){
            $this->error_message = "Please submit a BED file that is not empty in $attribute";
            return false;
        }
        else{
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
