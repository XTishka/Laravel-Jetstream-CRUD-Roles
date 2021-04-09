<?php

namespace Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
{
    protected $table = "fnc_currencies";

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => [
                'string',
                'required',
                'unique:fnc_currencies',
            ],
            'code' => [
                'string',
                'required',
                'unique:fnc_currencies',
                'size:3',

                // Check for uppercase
                function ($attribute, $value, $fail) {
                    if (strtoupper($value) != $value) {
                        $fail('The ' . $attribute . ' must be uppercase.');
                    }
                },
            ],
            'designation' => [
                'string',
                'required',
                'unique:fnc_currencies',
                'max:10'
            ],
            'base_currency' => [
                'string',
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
