<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shop\Field;
use App\Models\Shop\FieldOption;
use App\Models\Shop\FieldValue;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShopFieldStoreRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Shop\Category;
class ShopFieldController extends Controller
{

    /**
     * Field list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $fields = null;
        $categoryId = null;

        $categories = Category::lists('name','id')->toArray();

        if($request->has('category_id')){
            $fields = Field::where('category_id',$request->get('category_id'))->get();
            $categoryId = $request->get('category_id');
        }

        return view('backend.shop.field.index', compact('fields','categories','categoryId'));
    }

    /**
     * Store field
     *
     * @param ShopFieldStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ShopFieldStoreRequest $request)
    {
        $field = Field::create(
            $request->only(['name','content','type','category_id'])
        );
        return response()->json(['status'=>'ok','field'=>$field->toArray()]);

    }

    /**
     * Render field template
     *
     * @param Request $request
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
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

    /**
     * Field edit page
     *
     * @param Field $field
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Field $field)
    {
       return view('backend.shop.field.edit-form', compact('field'));
    }

    /**
     * Update field
     *
     * @param Request $request
     * @param Field $field
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Field $field)
    {
        if(!is_null($field)){
            $field->update(
                $request->only(['name','content','type'])
            );
        }
        return response()->json(['status'=>'ok','field'=>$field->toArray()]);
    }

    /**
     * Delete field
     *
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Field $field)
    {
        if(!is_null($field)){
            $field->delete();
            Session::flash('message','Поле удалена');
        }
        return redirect()->back();
    }


    public function getOptionsForm(Request $request, Field $field)
    {
        $options = $field->options;
        $fields = Field::where('category_id',$field->category_id)->whereNotIn('id',[$field->id])->lists('name','id')->toArray();
        return view('backend.shop.field.options',compact('options','field','fields'));
    }

    public function storeOrUpdateOptions(Request $request)
    {
        $text = trim($request->get('field_options'));
        $textAr = explode("\n", $text);
        $textAr = array_filter($textAr, 'trim'); // remove any extra \r characters left behind

        $field = Field::find($request->get('field_id'));


        foreach ($textAr as $line) {
            $option = explode('|',$line);

            $result = $field->options->where('name',$option[0])->first();

            if(is_null($result)) {
                FieldOption::create(
                    [
                        'name'    => $option[0],
                        'content' => (array_key_exists(1,$option))?$option[1]:null,
                        'field_id' => $field->id,
                    ]
                );
            }else{
                $result->update(
                    [
                        'content' => (array_key_exists(1,$option))?$option[1]:null
                    ]
                );
            }
        }

        Session::flash('message','Опции добавлены');
        return redirect()->route('field.index');

    }

    public function destroyOption(Request $request, FieldOption $option)
    {
        $option->delete();
        Session::flash('message','Опция удалена');
        return redirect()->route('field.index');
    }

}
