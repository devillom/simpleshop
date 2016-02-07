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


Route::group(['middleware' => ['web','admin'],'prefix' => 'manager'], function () {
    Route::get('/','Backend\HomeController@index')->name('manager.index');

    //User manager
    Route::resource('users', 'Backend\UserController');
    Route::post('users/{user}/ban', 'Backend\UserController@ban')->name('manager.users.ban');
    Route::post('users/{user}/unban', 'Backend\UserController@unban')->name('manager.users.unban');

    //Shop Category

    Route::group(['prefix' => 'shop'], function () {
        Route::resource('categories', 'Backend\ShopCategoryController');
    });


});
