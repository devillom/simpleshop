<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ShopProductUpdateRequest extends Request
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
            'name'=>'required|max:100',
            'price'=>'required|numeric',
            'category_id' => 'required|exists:shop_categories,id',
            'photos.*' => 'exists:photos,id',
            'fields.*' => 'exists:shop_fields,id',
            'field.*.value_int' => 'numeric',
            'field.*.value_str' => 'max:255',
            'field.*.value_dt' => 'date',
            //'field.*.value_text' => 'max:',
            'field.*.value_select' => 'exists:shop_field_options,id',
        ];
    }
}
