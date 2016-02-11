<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shop\Category;
use App\Models\Shop\FieldValue;
use App\Models\Shop\Product;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShopProductStoreRequest;
use App\Http\Requests\Backend\ShopProductUpdateRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Shop\Field;

class ShopProductController extends Controller
{
    /**
     * Product list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(20);
        return view('backend.shop.product.index', compact('products'));
    }

    /**
     * Product edit form page
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $fields = Field::whereNotIn('id', $product->fields->lists('id'))->lists('name', 'id')->toArray();
        $categories = Category::lists('name', 'id')->toArray();
        return view('backend.shop.product.edit', compact('categories', 'product', 'fields'));
    }

    /**
     * Product update
     *
     * @param ShopProductUpdateRequest $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ShopProductUpdateRequest $request, Product $product)
    {
        $product->update(
            $request->only('name', 'content', 'price', 'active')
        );

        if ($request->has('photos')) {
            $photos = Photo::whereIn('id', $request->get('photos'))->get();
            $product->photos()->saveMany($photos);
        }

        if ($request->has('category_id')) {
            $product->categories()->sync($request->only('category_id'));
        }


        if ($request->has('field')) {
            //@Todo check field before save
            $product->values()->delete();

            $product->fields()->sync(array_keys($request->field));

            foreach ($request->field as $fieldId => $value) {


                $field = Field::findOrFail($fieldId);
                FieldValue::create([
                    $field->type => $value[$field->type],
                    'product_id' => $product->id,
                    'field_id' => $field->id
                ]);
            }
        } else {
            $product->values()->delete();
            $product->fields()->detach();
        }

        if ($request->has('fields')) {
            $product->fields()->attach($request->get('fields'));
        }

        Session::flash('message', 'Товар обнавлен');
        return redirect()->route('manager.shop.product.edit', $product->id);
    }

    /**
     * Product create form page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $fields = Field::lists('name', 'id')->toArray();
        $categories = ['' => 'Выберите категорию'] + Category::lists('name', 'id')->toArray();
        return view('backend.shop.product.create', compact('categories', 'fields'));
    }

    /**
     * Product store
     *
     * @param ShopProductStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShopProductStoreRequest $request)
    {

        $product = Product::create($request->only('name', 'content', 'price', 'active'));

        if ($request->has('photos')) {
            $photos = Photo::whereIn('id', $request->get('photos'))->get();
            $product->photos()->saveMany($photos);
        }
        if ($request->has('category_id')) {
            $product->categories()->attach($request->get('category_id'));
        };
            //@Todo check field before save
            $product->fields()->attach(array_keys($request->field));


            foreach ($request->get('field') as $fieldId => $value) {
                if(!empty($value))
                {
                    $field = Field::findOrFail($fieldId);
                    FieldValue::create([
                        $field->type => $value[$field->type],
                        'product_id' => $product->id,
                        'field_id' => $field->id
                    ]);
                }
            }


        if ($request->has('fields')) {
            $product->fields()->attach($request->get('fields'));
        }

        Session::flash('message', 'Товар добавлен');
        return redirect()->route('manager.shop.product.edit', $product->id);
    }


    /**
     * Delete product
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        if (!is_null($product)) {
            $product->delete();
            Session::flash('message', 'Товар удален');
        }
        return redirect()->route('manager.shop.product.index');
    }
}
