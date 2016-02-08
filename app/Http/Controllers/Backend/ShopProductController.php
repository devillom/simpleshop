<?php

namespace App\Http\Controllers\Backend;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShopProductStoreRequest;
use App\Http\Requests\Backend\ShopProductUpdateRequest;
use Illuminate\Support\Facades\Session;

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
        $categories = Category::lists('name', 'id')->toArray();
        return view('backend.shop.product.edit', compact('categories', 'product'));
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

        if($request->has('photos')){
            $photos = Photo::whereIn('id',$request->get('photos'))->get();
            $product->photos()->saveMany($photos);
        }

        if ($request->has('category_id')) {
            $product->categories()->sync($request->only('category_id'));
        }

        Session::flash('message', 'Товар обнавлен');
        return redirect()->route('manager.shop.product.index');
    }

    /**
     * Product create form page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->toArray();
        return view('backend.shop.product.create', compact('categories'));
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

        if($request->has('photos')){
            $photos = Photo::whereIn('id',$request->get('photos'))->get();
            $product->photos()->saveMany($photos);
        }
        if ($request->has('category_id')) {
            $product->categories()->attach($request->get('category_id'));
        }

        Session::flash('message', 'Товар добавлен');
        return redirect()->route('manager.shop.product.index');
    }
}
