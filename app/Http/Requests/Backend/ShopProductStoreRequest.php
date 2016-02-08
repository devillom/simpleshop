<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Request;

class ShopProductStoreRequest extends Request
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
            'price'=>'numeric',
            'category_id' => 'required|exists:shop_categories,id',
            'photos.*' => 'exists:photos,id',
        ];
    }
}