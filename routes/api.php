<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function (Request $request) {
    return 'Alive: 1';
});

Route::get(
    '/files',
    'FileMetadataController@index'
);

Route::get(
    '/file/{fileID}',
    'FileMetadataController@show'
);

Route::post(
    '/file/upload',
    'FileMetadataController@store'
);

Route::post(
    '/file/edit',
    'FileMetadataController@update'
);
