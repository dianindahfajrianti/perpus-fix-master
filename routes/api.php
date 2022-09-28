<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as SRoute;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

SRoute::apiResource('books',Api\V1\BookController::class)->only(['index','show']);
SRoute::apiResource('videos',Api\V1\VideoController::class)->only(['index','show']);
// SRoute::prefix('sync')->group(function(){
SRoute::get('syncbook/{school}', 'Api\V1\BookController@sync');
SRoute::get('syncvid/{school}', 'Api\V1\VideoController@sync');
// });