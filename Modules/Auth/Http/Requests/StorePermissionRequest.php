<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('permissions_management');
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
                'unique:permissions',
            ],
            'slug' => [
                'string',
                'required',
                'unique:permissions',
            ],
            'description' => [
                'string',
            ],
        ];
    }
}
