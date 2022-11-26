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
    Route::get('admin/viewAdmins', 'viewAdmins');
    Route::get('admin/registerAdmin', 'registerAdmin');

    // packages route
    Route::get('admin/packages/', 'viewPackages');
    Route::get('admin/package/{id}', 'viewSinglePackage');
    Route::get('admin/addPackage', 'addPackage');

    // partners route
    Route::get('admin/partners/', 'viewPartners');
    Route::get('admin/partner/{id}', 'viewSinglePartner');
    Route::get('admin/addPartner', 'addPartner');
}); 
