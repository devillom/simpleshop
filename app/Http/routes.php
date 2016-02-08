<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['web']], function () {
    //
});

//
Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/role', function(){

        //\Spatie\Permission\Models\Role::create(['name' => 'admin']);
        //\Spatie\Permission\Models\Role::create(['name' => 'user']);
        //\Illuminate\Support\Facades\Auth::user()->assignRole('admin');

    });
});


Route::group(['middleware' => ['web','auth']], function () {
    Route::post('api/photo/upload', 'PhotoController@upload')->name('photo.upload');
    Route::post('api/photo/delete', 'PhotoController@delete')->name('photo.delete');
});

Route::group(['middleware' => ['web','auth','admin'],'prefix' => 'manager'], function () {
    Route::get('/','Backend\HomeController@index')->name('manager.index');

    //User manager
    Route::resource('user', 'Backend\UserController',['except' => ['show']]);
    Route::post('user/{user}/ban', 'Backend\UserController@ban')->name('manager.user.ban');
    Route::post('user/{user}/unban', 'Backend\UserController@unban')->name('manager.user.unban');


    Route::group(['prefix' => 'shop'], function () {
        //Shop Category
        Route::resource('category', 'Backend\ShopCategoryController',['except' => ['show']]);
        Route::get('category/reorder', 'Backend\ShopCategoryController@getReorder')->name('manager.shop.category.reorder');
        Route::post('category/reorder/action', 'Backend\ShopCategoryController@setReorder')->name('manager.shop.category.reorder.action');

        //Shop Product
        Route::resource('product', 'Backend\ShopProductController',['except' => ['show']]);

    });




});
