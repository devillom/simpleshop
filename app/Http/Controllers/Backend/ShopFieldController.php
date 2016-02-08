<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shop\Field;
use App\Models\Shop\FieldValue;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShopFieldStoreRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Shop\Category;
class ShopFieldController extends Controller
{

    public function index()
    {
        $fields = Field::all();
        return view('backend.shop.field.index', compact('fields'));
    }
    public function store(ShopFieldStoreRequest $request)
    {
        $field = Field::create(
            $request->only(['name','content','type'])
        );
        return response()->json(['status'=>'ok','field'=>$field->toArray()]);

    }


    public function getCategoryFields(Request $request)
    {
        if($request->has('category_id')){

            $productId = $request->get('product_id',null);

            $category = Category::with('fields')->findOrFail($request->get('category_id'));

            $fields =  $category->fields;

            $view =  view('backend.shop.field.types', compact('fields','productId'));
            return $view->render();
        }
    }

    public function edit(Field $field)
    {
       return view('backend.shop.field.edit-form', compact('field'));
    }


    public function update(Request $request, Field $field)
    {
        if(!is_null($field)){
            $field->update(
                $request->only(['name','content','type'])
            );
        }
        return response()->json(['status'=>'ok','field'=>$field->toArray()]);
    }

    public function destroy(Field $field)
    {
        if(!is_null($field)){
            $field->delete();
            Session::flash('message','Поле удалена');
        }
        return redirect()->route('field.index');
    }


}
