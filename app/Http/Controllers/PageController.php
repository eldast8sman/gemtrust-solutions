<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('pages/home');
    }

    public function terms(){
        return view('pages/terms_conditions');
    }

    public function admin(){
        return view('admin/home');
    }

    public function viewAdmins(){
        return view('admin/viewAdmins');
    }
    
    public function registerAdmin(){
        return view('admin/registerAdmin');
    }

    public function adminLogin(){
        return view('admin/signin');
    }
}
