<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Backend\ShopCategoryStoreRequest;
use App\Http\Requests\Backend\ShopCategoryUpdateRequest;
use App\Http\Requests\Backend\ShopCategoryReorderRequest;
use App\Models\Shop\Category;
use App\Models\Shop\Field;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;


class ShopCategoryController extends Controller
{
    /**
     * Category list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $categories = Category::orderBy('id', 'desc')->paginate(20);
        return view('backend.shop.category.index', compact('categories'));
    }

    /**
     * Category create form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $fields = Field::lists('name', 'id')->toArray();
        $categories = ['' => 'Родительская категория'] + Category::lists('name', 'id')->toArray();
        return view('backend.shop.category.create', compact('categories', 'fields'));
    }

    /**
     * Store Category
     *
     * @param ShopCategoryStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShopCategoryStoreRequest $request)
    {

        $category = Category::create(
            [
                'name' => $request->get('name'),
                'content' => $request->get('content')
            ]
        );

        if ($request->has('parent_id')) {
            $parent = Category::find($request->get('parent_id'));
            $parent->children()->save($category);
        }

        if ($request->has('fields')) {
            $category->fields()->attach($request->get('fields'));
        }

        Session::flash('message', 'Категория создана');
        return redirect()->route('manager.shop.category.index');
    }

    /**
     * Edit category form
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $fields = Field::lists('name', 'id')->toArray();
        $categories = ['' => 'Родительская категория'] + Category::where('id', '!=', $category->id)
                ->whereNotIn('id', $category->children()->lists('id')->toArray())
                ->lists('name', 'id')->toArray();

        return view('backend.shop.category.edit', compact('category', 'categories', 'fields'));
    }

    /**
     * Update Category
     *
     * @param ShopCategoryUpdateRequest $request
     * @param $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ShopCategoryUpdateRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->get('name'),
            'content' => $request->get('content')
        ]);

        if ($request->has('parent_id')) {
            $parent = Category::find($request->get('parent_id'));
            $parent->children()->save($category);
        } else {
            $category->parent_id = null;
            $category->save();
        }

        if ($request->has('fields')) {
            $category->fields()->sync($request->get('fields'));
        }

        Session::flash('message', 'Категория изменено');
        return redirect()->route('manager.shop.category.index');
    }

    /**
     * Delete Category
     *
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('message', 'Категория удалено');
        return redirect()->route('manager.shop.category.index');
    }

    /**
     * Reorder page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getReorder()
    {

        $results = Category::get();

        $tree = $results->toTree();
        return view('backend.shop.category.reorder', compact('tree'));
    }

    /**
     * Reorder nestable
     *
     * @param ShopCategoryReorderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setReorder(ShopCategoryReorderRequest $request)
    {
        //@TODO Reorder need fix
        $categories = json_decode($request->get('data'), true);

        Category::updateTreeRoots($categories);
        Category::rebuildTree($categories);
        Category::fixTree();
        // Category::update($categories);
        return response()->json(['status' => 'ok']);
    }
}
