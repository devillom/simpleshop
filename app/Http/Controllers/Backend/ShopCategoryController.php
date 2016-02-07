<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Session;
use App\User;
use App\Models\Shop\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ShopCategoryStoreRequest;
use App\Http\Requests\Backend\ShopCategoryUpdateRequest;

class ShopCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('backend.shop.category.index',compact('categories'));
    }

    public function create()
    {
        $categories = Category::lists('name','id')->all();
        return view('backend.shop.category.create',compact('categories'));
    }

    public function store(ShopCategoryStoreRequest $request)
    {
        $data = $request->all();

        if(isset($data['parent_id'])) {
            $parent = Category::find($data['parent_id']);
            $parent->children()->create(
                [
                    'name'=>$data['name'],
                    'content'=>$data['content']
                ]
            );
        }else{
            Category::create(
                [
                    'name'=>$data['name'],
                    'content'=>$data['content']
                ]
            );
        }

        Session::flash('message','Категория создана');
        return redirect()->route('manager.shop.categories.index');
    }

    public function edit(Category $categories)
    {
        $category = $categories;
        $categories = Category::lists('name','id')->all();
        return view('backend.shop.category.edit',compact('category','categories'));
    }

    public function update(ShopCategoryUpdateRequest $request, $categories)
    {
        $data = $request->all();
        $category = Category::findOrFail($categories);

        $category->update([
            'name'=>$data['name'],
            'content'=>$data['content']
        ]);

        if(isset($data['parent_id'])) {
            $parent = Category::find($data['parent_id']);
            $parent->children()->save($category);
        }


       // $category->move()

        Session::flash('message','Категория изменено');
        return redirect()->route('manager.shop.categories.index');
    }
}
