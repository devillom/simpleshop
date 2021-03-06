<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class UserStoreRequest extends Request
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
        return [

            'username' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'roles'=>'required|exists:roles,id'
        ];

    }
}
