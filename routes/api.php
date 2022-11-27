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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//route for admin
Route::group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\admin', 'as' => 'admin.'], function(){
    Route::resource('organisation', OrganisationController::class);
    Route::resource('categorie', CategorieController::class);
    Route::resource('ressource', RessourceController::class);
    Route::resource('media', MediaController::class);

});


//route for user
Route::group(['prefix' => 'user', 'namespace' => 'App\Http\Controllers\user', 'as' => 'user.'], function(){
    Route::resource('emprunter',EmprunterController::class);
    Route::resource('notification', NotificationController::class);
    Route::resource('reservation',ReserverController::class);
});



