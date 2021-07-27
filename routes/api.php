<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\MaterialApiController;
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

//TODO:middleware
Route::get('getbycategory/{categoryId}',[\App\Http\Controllers\API\MaterialApiController::class,'getByCategory']);

Route::apiResource('material', \App\Http\Controllers\API\MaterialApiController::class)->except([
    'create', 'store', 'update', 'destroy'
]);

