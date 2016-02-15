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
use App\Http\Requests\Backend\ShopFieldOptionStoreRequest;

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

        $categories = Category::lists('name', 'id')->toArray();

        if ($request->has('category_id')) {
            $fields = Field::where('category_id', $request->get('category_id'))
                ->where('option_id',null)->get();
            $categoryId = $request->get('category_id');
        }

        return view('backend.shop.field.index', compact('fields', 'categories', 'categoryId'));
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
            $request->only(['name', 'content', 'type', 'category_id'])
        );
        return response()->json(['status' => 'ok', 'field' => $field->toArray()]);

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
        if ($request->has('category_id')) {

            $productId = $request->get('product_id', null);

            $category = Category::with('fields')->findOrFail($request->get('category_id'));

            $fields = $category->fields()->where('option_id',null)->get();

            $view = view('backend.shop.field.types', compact('fields', 'productId'));
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
        if (!is_null($field)) {
            $field->update(
                $request->only(['name', 'content', 'type'])
            );
        }
        return response()->json(['status' => 'ok', 'field' => $field->toArray()]);
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
        if (!is_null($field)) {
            $field->delete();
            Session::flash('message', 'Поле удалена');
        }
        return redirect()->back();
    }

    /**
     * Get options form
     *
     * @param Request $request
     * @param Field $field
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getOptionsForm(Request $request, Field $field)
    {
        $options = $field->options;
        $fields = Field::where('category_id', $field->category_id)->whereNotIn('id', [$field->id])->lists('name', 'id')->toArray();
        return view('backend.shop.field.options', compact('options', 'field', 'fields'));
    }

    /**
     * Store field options
     *
     * @param ShopFieldOptionStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeOptions(ShopFieldOptionStoreRequest $request)
    {
        $text = trim($request->get('field_options'));
        $textAr = explode("\n", $text);
        $textAr = array_filter($textAr, 'trim'); // remove any extra \r characters left behind

        $field = Field::find($request->get('field_id'));

        foreach ($textAr as $line) {
            $option = explode('|', $line);

            FieldOption::create(
                [
                    'name' => $option[0],
                    'content' => (array_key_exists(1, $option)) ? $option[1] : null,
                    'field_id' => $field->id,
                ]
            );
        }

        Session::flash('message', 'Опции добавлены');
        return redirect()->back();

    }

    /**
     * Delete option
     *
     * @param FieldOption $option
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroyOption(FieldOption $option)
    {
        $option->delete();
        Session::flash('message', 'Опция удалена');
        return redirect()->back();
    }


    public function getOptionUpdateForm(FieldOption $option)
    {
        return view('backend.shop.field.edit-option-form', compact('option'));
    }


    public function updateOption(Request $request, FieldOption $option)
    {

        $option->update(
            [
                'name'=>$request->get('name'),
                'content'=>$request->get('content')
            ]
        );

        Session::flash('message', 'Опция изменена');
        return redirect()->back();
    }


    public function storeOptionField(ShopFieldStoreRequest $request)
    {

        $field = Field::create(
            $request->only(['name', 'content', 'category_id', 'type', 'option_id'])
        );
        return response()->json(['status' => 'ok', 'field' => $field->toArray()]);
    }

    public function getOptionFields(Request $request)
    {
        if ($request->has('option_id')) {

            $optionId = $request->get('option_id');
            $productId = $request->get('product_id', null);

            $option = FieldOption::with('fields')->find($optionId);

            $fields = $option->fields;

            $view = view('backend.shop.field.types', compact('fields','productId'));
            return $view->render();
        }
    }

}
