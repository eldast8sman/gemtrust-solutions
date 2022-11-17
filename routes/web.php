<?php

use App\Http\Controllers\PageController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(PageController::class)->group(function(){
    Route::get('/', 'index');
    Route::get('terms_conditions', 'terms');
    Route::get('admin', 'admin');
    Route::get('admin/signup', 'adminSignup');
    Route::get('admin/signin', 'adminSignin');
}); 
