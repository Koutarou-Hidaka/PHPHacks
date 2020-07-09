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

// Route::get('/', function () {
//     return view('welcome');
// });


# HTTPのgetリクエストが飛ばされた時の処理
Route::get('/','PostController@index')->name('top');
# '/'一番上にアクセスされた時にPostControllerのindexに処理を割り振る
# nameはニックネームみたいなもの、これで'/'でも'top'でも呼び出せるようになった

