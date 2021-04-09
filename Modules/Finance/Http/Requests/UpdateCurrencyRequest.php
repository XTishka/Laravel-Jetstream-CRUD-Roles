<?php

namespace Modules\Finance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCurrencyRequest extends FormRequest
{
    protected $table = "fnc_currencies";

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currencyId = $this->route('id');
        return [
            'title'       => [
                'sometimes',
                'string',
                Rule::unique('fnc_currencies')->ignore($currencyId, 'id')
            ],
            'code' => [
                'sometimes',
                'string',
                'required',
                'size:3',
                Rule::unique('fnc_currencies')->ignore($currencyId, 'id'),

                // Check for uppercase
                function ($attribute, $value, $fail) {
                    if (strtoupper($value) != $value) {
                        $fail('The ' . $attribute . ' must be uppercase.');
                    }
                },
            ],
            'designation' => [
                'sometimes',
                'string',
                'required',
                'max:10',
                Rule::unique('fnc_currencies')->ignore($currencyId, 'id'),
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
