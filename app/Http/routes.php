<?php
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
});

Route::group(['middleware' => ['web','auth']], function () {
    //Photo
    Route::post('api/photo/upload', 'PhotoController@upload')->name('photo.upload');
    Route::post('api/photo/delete', 'PhotoController@delete')->name('photo.delete');

    //Field
    Route::get('api/category/fields', 'Backend\ShopFieldController@getCategoryFields')->name('category.fields');

    Route::get('api/category/fields/options/{field}', 'Backend\ShopFieldController@getOptionsForm')->name('category.field.option.form');
    Route::post('api/category/fields/options/{option}/destroy', 'Backend\ShopFieldController@destroyOption')->name('category.field.option.destroy');
    Route::post('api/category/fields/options', 'Backend\ShopFieldController@storeOrUpdateOptions')->name('category.field.option.store');

    Route::resource('field','Backend\ShopFieldController');
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

        Route::get('setting', 'Backend\ShopSettingsController@index')->name('manager.shop.setting.index');
        Route::post('setting', 'Backend\ShopSettingsController@update')->name('manager.shop.setting.update');
        //Shop Product
        Route::resource('product', 'Backend\ShopProductController',['except' => ['show']]);

    });




});
