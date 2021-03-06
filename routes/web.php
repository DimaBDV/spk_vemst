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


/**
 * Сервис функции
 * https://laravel-tricks.com/tricks/routing-patterns
 */
Route::pattern('id', '\d+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
/**
 * -----------------------------------------------------------------------------------------
 */


Route::get('/', 'WelcomeController@index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/test/{id}', 'Users\NotifyController@destroy')->middleware(['auth', 'verified']);

Route::post('/upload', 'Support\FileController@store')->name('upload.file');

// Только для подтверждённых пользователей
Route::middleware(['verified'])->group(function () {

    Route::prefix('offer')->group(function () {
        Route::get('/', "Users\OfferController@create")->name('offer');
        Route::get('/restore/{id}', 'Users\OfferController@restore')->name('offer.restore');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/', "Admin\OfferController@index")->name('admin.index');
        Route::get('/show/{id}', "Admin\OfferController@show")->name('admin.offer.show');
        Route::get('/download/file/{id}', "Admin\OfferController@downloadFile")->name('admin.offer.download.file');

        Route::put('/complete/{id}', "Admin\OfferController@update")->name('admin.offer.complete');
        Route::delete('/delete/{id}', "Admin\OfferController@destroy")->name('admin.offer.delete');
    });

    Route::prefix('webapi')->group(function () {

        Route::get('me', 'HomeController@me');

        Route::prefix('notify')->group(function (){
            Route::get('/', 'Users\NotifyController@index');
            Route::post('/read_all', 'Users\NotifyController@update');
            Route::delete('/delete/{uuid}', 'Users\NotifyController@destroy');
        });

        Route::post('upload', 'Support\FileController@store');
        Route::post('createnewoffer', 'Users\OfferController@store')->middleware('verified');


        Route::get('file/show/{id}','Support\FileController@show');
        Route::prefix('offer')->group(function () {

            Route::get('/list', "Users\OfferController@index");
            Route::delete('/delete/{id}', 'Users\OfferController@destroy');

        });

    });


});

