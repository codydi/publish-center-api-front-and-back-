<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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


Route::get('/login', function () {
    return view('login');
});

Route::get('/facebook/{accessToken}', 'FacebookController@showFaceBook');

Route::group(['middleware' => ['web', 'login']], function () {
    Route::get('/', function () {
        return view('dashboard')->with('posts', json_decode(\Storage::disk('local')->get('posts.json')));
    });

    Route::post('/', 'FacebookController@makepost');

    Route::get('/posts', function () {
        return view('posts')->with('posts', json_decode(\Storage::disk('local')->get('posts.json')));
    });

    Route::get('/delete/{id}', 'FacebookController@deletePost');
    Route::get('/data', function () {
        return view('facebook')->with('posts', json_decode(\Storage::disk('local')->get('posts.json')))->with('data', json_decode(\Storage::disk('local')->get('facebook.json')));
    });
    Route::get('/data/facebook', 'FacebookController@showManageDataPage');
    Route::post('/data/facebook', 'FacebookController@updateFacebookData');
    Route::get('/twitter/{accessToken}', 'FacebookController@showTwitter');


    Route::get('/setting', function () {
        return view('setting');
    });
});



Route::get('/test', function () {
    return view('menu');
});