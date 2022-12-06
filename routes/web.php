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

    Route::get('admin/login', 'adminLogin');

    // admininstrator route
    Route::get('admin', 'admin');
    Route::get('admin/admins', 'viewAdmins');
    Route::get('admin/admin/{id}', 'viewSingleAdmin');
    Route::get('admin/registerAdmin', 'registerAdmin');

    // packages route
    Route::get('admin/packages/', 'viewPackages');
    Route::get('admin/package/{id}', 'viewSinglePackage');
    Route::get('admin/addPackage', 'addPackage');

    // partners route
    Route::get('admin/partners/', 'viewPartners');
    Route::get('admin/partner/{id}', 'viewSinglePartner');
    Route::get('admin/addPartner', 'addPartner');

    // sections route
    Route::get('admin/sections/', 'viewSections');
    Route::get('admin/section/{id}', 'viewSingleSection');
    Route::get('admin/addSection', 'addSection');

    // article route
    Route::get('admin/articles/', 'viewArticles');
    Route::get('admin/article/{id}', 'viewSingleArticle');
    Route::get('admin/addArticle', 'addArticle');

    // admin signal providers route
    Route::get('admin/signalsProvider/', 'viewSignalsProvider');
    Route::get('admin/signalProvider/{id}', 'viewSignalProvider');
    Route::get('admin/addSignalProvider', 'addSignalProvider');

    // signal Provider route
    Route::get('signalsProvider', 'signalsProvider');
    Route::get('signalsProvider/login', 'signalsProviderLogin');
    Route::get('signalsProvider/verifyAccount/{verify_token}', 'sp_accountVerification');
});