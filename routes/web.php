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
    Route::get('/offer', "Users\OfferController@index")->name('offer');


    Route::post('/webapi/upload', 'Support\FileController@store');
});

