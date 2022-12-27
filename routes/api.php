<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SignalProviderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignalProvider\AuthController as SignalProviderAuthController;
use App\Http\Controllers\SignalSubscriberController;
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

        Route::controller(ArticleController::class)->group(function(){
            Route::get('/articles', 'index');
            Route::post('/articles', 'store');
            Route::get('/articles/{id}', 'show');
            Route::post('/articles/{id}', 'update');
            Route::delete('/articles/{id}', 'destroy');
        });
        
        Route::controller(SectionController::class)->group(function(){
            Route::get('/sections', 'index');
            Route::post('/sections', 'store');
            Route::get('/sections/{id}', 'show');
            Route::put('/sections/{id}', 'update');
            Route::delete('/sections/{id}', 'destroy');
        });

        Route::controller(SignalProviderController::class)->group(function(){
            Route::get('/signal-providers', 'index');
            Route::post('/signal-providers', 'store');
            Route::get('/signal-providers/{id}', 'show');
            Route::put('/signal-providers/{id}', 'update');
            Route::delete('/signal-providers/{id}', 'destroy');
        });
    });

    Route::controller(AdminAuthController::class)->group(function(){
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

Route::prefix('signal-provider')->group(function(){
    Route::controller(SignalProviderAuthController::class)->group(function(){
        Route::post('/login', 'login');
        Route::post('/activate', 'activate');
        Route::get('/resend-verification-link/{old_token}', 'resend_token');
        Route::get('/logut', 'logout');
    });
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/signup', 'store');
    Route::post('/login', 'login');
    Route::post('/activate', 'activate_user');
    Route::post('/resend-verification-link', 'resend_verification_link');
    Route::post('/forgot-password', 'forgot_password');
    Route::post('/reset-password', 'reset_password');
});

Route::middleware('auth:api')->group(function(){
    Route::controller(AuthController::class)->group(function(){
        Route::get('/logout', 'logout');
    });

    Route::controller(SignalSubscriberController::class)->group(function(){
        Route::get('/signal-providing/subscribe', 'subscribe');
        Route::get('/signal-providing/unsubscribe', 'unsubscribe');
    });
});
