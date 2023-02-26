<?php

use Orion\Facades\Orion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompteController;
use App\Http\Controllers\Api\MonaieController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\UserController;

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


Route::group(['as' => 'api.'], function() {
    Orion::resource('posts', PostController::class);
});

Route::post('login',[AuthController::class,'login']);
Route::post('depot',[TransactionController::class,'depot']);
Route::post('retrait',[TransactionController::class,'retrait']);


Route::group(["middleware"=>"auth:api"],function(){

    // Route pour l'insertion des différents types
    Route::post('new-type-utilisateur',[TypeController::class,'user']);
    Route::post('new-type-transaction',[TypeController::class,'transaction']);
    Route::post('new-type-monaie',[TypeController::class,'monaie']);
    Route::get('types',[TypeController::class,'index']);

    // Gestion des utilisateurs
    Route::resource('utilisateurs',UserController::class);

    // Gestion des comptes
    Route::resource('comptes',CompteController::class);

    //gestion de monaie
    Route::resource('monaies',MonaieController::class);

    Route::get('logout',[AuthController::class,'logout']);
});
