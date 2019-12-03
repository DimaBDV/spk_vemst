<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
|   Правила заполнения листа маршрутов
|--------------------------------------------------------------------------
|
| Если вы хотите в дальнейшем кешировать лист маршрутов придерживайтесь
| одного очень важного правила.
|
|       ВСЕ МАРШРУТЫ ДОЛЖНЫ ВЕСТИ НА КОНТРОЛЛЕР
|         ИСПОЛЬЗОВАНИЕ ЗАМЫКАНИЙ НЕДОПУСТИМО
|
*/

Route::get('/', 'WelcomeController@index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function (){
    return view('user.test');
})->middleware(['auth', 'verified']);

Route::post('/upload', 'Support\FileController@store')->name('upload.file');

// Только для подтверждённых пользователей
Route::middleware(['verified'])->group(function () {

    Route::prefix('offer')->group(function () {
        Route::get('/', "Users\OfferController@create")->name('offer');
        Route::get('/restore/{id}', 'Users\OfferController@restore')->where('id', '[0-9]+')->name('offer.restore');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', "Admin\OfferController@index");
    });

    Route::prefix('webapi')->group(function () {

        Route::post('upload', 'Support\FileController@store');
        Route::post('createnewoffer', 'Users\OfferController@store')->middleware('verified');


        Route::get('file/show/{id}','Support\FileController@show')->where('id', '[0-9]+');
        Route::prefix('offer')->group(function () {

            Route::get('/list', "Users\OfferController@index");
            Route::delete('/delete/{id}', 'Users\OfferController@destroy')->where('id', '[0-9]+');

        });

    });


});

