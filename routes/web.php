<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard')
        ->with('posts', json_decode(\Storage::disk('local')->get('posts.json')));
});

Route::post('/', 'FacebookController@makepost');
Route::get('/facebook/{accessToken}', 'FacebookController@showFaceBook');
Route::get('/data/facebook', 'FacebookController@showManageDataPage');
Route::post('/data/facebook', 'FacebookController@updateFacebookData');