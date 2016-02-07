<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ShopCategoryUpdateRequest extends Request
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
            'name' => 'required|unique:shop_categories,name,'.$this->get('id'),
            'content' => 'max: 500',
            'parent_id' => 'exists:shop_categories,id'
        ];
    }
}
