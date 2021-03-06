<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ShopFieldStoreRequest extends Request
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
            'name'=>'required',
            'type'=>'in:value_str,value_int,value_text,value_dt,value_select',
            'category_id' => 'required|exists:shop_categories,id'
        ];
    }
}
