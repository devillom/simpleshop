<?php
Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', 'HomeController@index');
});

Route::group(['middleware' => ['web', 'auth']], function () {
    //Photo
    Route::post('api/photo/upload', 'PhotoController@upload')->name('photo.upload');
    Route::post('api/photo/delete', 'PhotoController@delete')->name('photo.delete');
});

Route::group(['middleware' => ['web', 'auth', 'admin'], 'prefix' => 'manager'], function () {

    //Manager home page
    Route::get('/', 'Backend\HomeController@index')
        ->name('manager.index');

    //User manager
    Route::resource('user', 'Backend\UserController', ['except' => ['show']]);
    Route::post('user/{user}/ban', 'Backend\UserController@ban')
        ->name('manager.user.ban');
    Route::post('user/{user}/unban', 'Backend\UserController@unban')
        ->name('manager.user.unban');

    //Shop routes
    Route::group(['prefix' => 'shop'], function () {

        //Shop Category
        Route::resource('category', 'Backend\ShopCategoryController', ['except' => ['show']]);
        Route::get('category/reorder', 'Backend\ShopCategoryController@getReorder')
            ->name('manager.shop.category.reorder');
        Route::post('category/reorder/action', 'Backend\ShopCategoryController@setReorder')
            ->name('manager.shop.category.reorder.action');

        //Shop settings
        Route::get('setting', 'Backend\ShopSettingsController@index')
            ->name('manager.shop.setting.index');
        Route::post('setting', 'Backend\ShopSettingsController@update')
            ->name('manager.shop.setting.update');

        //Shop Product
        Route::resource('product', 'Backend\ShopProductController', ['except' => ['show']]);

        //Field
        Route::get('api/fields', 'Backend\ShopFieldController@getCategoryFields')
            ->name('manager.shop.category.fields');

        Route::get('api/fields/options/{field}', 'Backend\ShopFieldController@getOptionsForm')
            ->name('manager.shop.category.field.option.form');

        Route::post('api/fields/options/{option}/destroy', 'Backend\ShopFieldController@destroyOption')
            ->name('manager.shop.category.field.option.destroy');

        Route::post('api/fields/options', 'Backend\ShopFieldController@storeOptions')
            ->name('manager.shop.category.field.option.store');

        Route::get('api/fields/options/{option}/edit', 'Backend\ShopFieldController@getOptionUpdateForm')
            ->name('manager.shop.category.field.option.edit.form');

        Route::patch('api/fields/options/{option}/update', 'Backend\ShopFieldController@updateOption')
            ->name('manager.shop.category.field.option.update');

        Route::get('api/fields/option/fields', 'Backend\ShopFieldController@getOptionFields')
            ->name('manager.shop.category.option.fields');


        Route::post('api/fields/option/field/store','Backend\ShopFieldController@storeOptionField')
            ->name('manager.shop.field.store.option.field');

        Route::resource('field', 'Backend\ShopFieldController');



    });


});
