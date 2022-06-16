<?php

namespace App\Http\Requests;

use App\Rules\ValidateBED;
use App\Rules\ValidateCHR;
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
                'caseId' => 'required',
                'email' => 'bail|required|email|max:100',
                'gtf' => ['required_without:ens_gtf',new ValidateGTF],
                'ens_gtf' => 'exclude_if:ens_gtf,null|required_without:gtf',
                'bed' => ['required',new ValidateBED],
                'chr' => ['required',new ValidateCHR],
                'mbed.*' => [new ValidateBED],
                'mbedl' => ['exclude_if:mbedl,null',new Delimited('alpha_dash')],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'ups' => 'exclude_if:ups,null|numeric',
                'dns' => 'exclude_if:dns,null|numeric',
                "fcg" => "filled",
                "fcp" => "filled",
                "fcmb" => "filled"
                
            ];
        }

        if ($this->input('caseId') === "case2"){
            return [
                'caseId' => 'required',
                'email' => 'bail|required|email|max:100',
                'gtf' => ['required_without:ens_gtf',new ValidateGTF],
                'ens_gtf' => 'exclude_if:ens_gtf,null|required_without:gtf',
                'bed' => ['required',new ValidateBED],
                'keys' => ['required',new Delimited('alpha_dash')],
                'chr' => ['required',new ValidateCHR],
                'mbed.*' => [new ValidateBED],
                'mbedl' => ['exclude_if:mbedl,null',new Delimited('alpha_dash')],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'ups' => 'exclude_if:ups,null|numeric',
                'dns' => 'exclude_if:dns,null|numeric',
                "fcg" => "filled",
                "fcp" => "filled",
                "fcmb" => "filled"
            ];
        }

        if ($this->input('caseId') === "case3"){
            return [
                'caseId' => 'required',
                'email' => 'bail|required|email|max:100',
                'mbed' => 'required',
                'mbed.*' => [new ValidateBED],
                'bed' => ['required',new ValidateBED],
                'chr' => ['required',new ValidateCHR],
                'mbedl' => ['exclude_if:mbedl,null',new Delimited('alpha_dash')],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'ups' => 'exclude_if:ups,null|numeric',
                'dns' => 'exclude_if:dns,null|numeric',
                "fcg" => "filled",
                "fcp" => "filled",
                "fcmb" => "filled"
            ];
        }

        if ($this->input('caseId') === "case4"){
            return [
                'caseId' => 'required',
                'email' => 'bail|required|email|max:100',
                'mbed' => 'required',
                'mbed.*' => [new ValidateBED],
                'bed' => ['required',new ValidateBED],
                'chr' => ['required',new ValidateCHR],
                'bedin' => [new ValidateBED],
                'bedex' => [new ValidateBED],
                'max' => 'exclude_if:max,null|numeric|nullable',
                'exact' => "filled"
            ];
        }
    }
}
