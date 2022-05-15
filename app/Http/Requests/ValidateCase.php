<?php

namespace App\Http\Requests;

use App\Rules\ValidateBED;
use App\Rules\ValidateGTF;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\ValidationRules\Rules\Delimited;

class ValidateCase extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        
        if ($this->input('caseId') === "case1"){
            return [
                'email' => 'bail|required|email|max:100',
                'gtf' => ['required',new ValidateGTF],
                'bed' => ['required',new ValidateBED],
                'chr' => 'required',
                'mbed' => [new ValidateBED],
                'mbedl' => [new Delimited('alpha_dash')],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'ups' => 'numeric|nullable',
                'dns' => 'numeric|nullable'
            ];
        }

        if ($this->input('caseId') === "case2"){
            return [
                'email' => 'bail|required|email|max:100',
                'gtf' => ['required',new ValidateGTF],
                'bed' => ['required',new ValidateBED],
                'keys' => ['required',new Delimited('alpha_dash')],
                'chr' => 'required',
                'mbed' => [new ValidateBED],
                'mbedl' => [new Delimited('alpha_dash')],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'ups' => 'numeric|nullable',
                'dns' => 'numeric|nullable'
            ];
        }

        if ($this->input('caseId') === "case3"){
            return [
                'email' => 'bail|required|email|max:100',
                'mbed' => ['required',new ValidateBED],
                'bed' => ['required',new ValidateBED],
                'chr' => 'required',
                'mbedl' => [new Delimited('alpha_dash')],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'ups' => 'numeric|nullable',
                'dns' => 'numeric|nullable'
            ];
        }

        if ($this->input('caseId') === "case4"){
            return [
                'email' => 'bail|required|email|max:100',
                'mbed' => ['required',new ValidateBED],
                'bed' => ['required',new ValidateBED],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'max'=> 'numeric|nullable'
            ];
        }
    }
}
