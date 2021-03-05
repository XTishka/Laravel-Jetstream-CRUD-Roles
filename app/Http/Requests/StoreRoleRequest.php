<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('roles_management');
    }

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
                'unique:roles',
            ],
            'slug' => [
                'string',
                'required',
                'unique:roles',
            ],
            'description' => [
                'string',
            ],
            'permissions.*'  => [
                'integer',
            ],
            'permissions'    => [
                'required',
                'array',
            ],
        ];
    }
}
