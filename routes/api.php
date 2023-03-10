<?php

use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//Protected routes
Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
});

//Api\V1 Routes
Route::group(['prefix'=>'v1', 'namespace'=>'App\Http\Controllers\Api\V1', 'middleware'=>'auth:sanctum'], function(){
    Route::apiResource('students', StudentController::class);
    Route::get('students/search-name/{name}', [StudentController::class, 'searchByName']);
    Route::get('students/search-email/{email}', [StudentController::class, 'searchByEmail']);
});