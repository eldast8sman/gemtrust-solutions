<?php

use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PartnerController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('admin')->group(function(){
    Route::middleware('auth:admin-api')->group(function(){
        Route::controller(App\Http\Controllers\Admin\AuthController::class)->group(function(){
            Route::get('me', 'me');
        });

        Route::controller(BankController::class)->group(function(){
            Route::post('/banks', 'bank_setup');
            Route::get('/banks', 'index');
        });

        Route::controller(PartnerController::class)->group(function(){
            Route::get('/partners', 'index');
            Route::post('/partners', 'store');
            Route::get('/partners/{id}', 'show');
            Route::put('/partners/{id}', 'update');
            Route::delete('/partners/{id}', 'destroy');
            Route::get('/partners/{id}/wallet', 'fetchWallet');
        });

        Route::controller(PackageController::class)->group(function(){
            Route::get('/packages', 'index');
            Route::post('/packages', 'store');
            Route::get('/packages/{id}', 'show');
            Route::put('/packages/{id}', 'update');
            Route::delete('/packages/{id}', 'destroy');
            Route::post('/packages/{id}/add-partner', 'addPartner');
            Route::delete('/packages/remove-partner/{id}', 'removePartner');
        });
    });

    Route::controller(App\Http\Controllers\Admin\AuthController::class)->group(function(){
        Route::post('login', 'login');
        Route::post('admins', 'store');
        Route::get('admins', 'index');
        Route::get('admins/{id}', 'show');
        Route::put('admins/{id}', 'update');
        Route::put('change-password', 'changePassword');
        Route::delete('admins/{id}', 'destroy');
        Route::get('/logout', 'logout');
    });
});
