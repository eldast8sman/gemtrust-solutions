<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Landing Page Function
    public function index() {
        return view('pages/home');
    }

    public function terms() {
        return view('pages/terms_conditions');
    }


    // Admin Function
    public function admin() {
        return view('admin/home');
    }

    public function viewAdmins() {
        return view('admin/viewAdmins');
    }
    
    public function viewSingleAdmin($id) {
        return view('admin/viewSingleAdmin', ["admin_id" => $id]);
    }

    public function registerAdmin() {
        return view('admin/registerAdmin');
    }

    public function adminLogin() {
        return view('admin/signin');
    }


    // Package Functions
    public function viewPackages() {
        return view("admin/viewPackages");
    }

    public function viewSinglePackage($id) {
        return view("admin/viewSinglePackage", ["package_id" => $id]);
    }

    public function addPackage() {
        return view('admin/addPackage');
    }


    // Partner Functions
    public function viewPartners() {
        return view("admin/viewPartners");
    }

    public function viewSinglePartner($id) {
        return view("admin/viewSinglePartner", ["partner_id" => $id]);
    }

    public function addPartner() {
        return view('admin/addPartner');
    }


    // Section Functions
    public function viewSections() {
        return view("admin/viewSections");
    }

    public function viewSingleSection($id) {
        return view("admin/viewSingleSection", ["section_id" => $id]);
    }

    public function addSection() {
        return view('admin/addSection');
    }


    // Article Functions
    public function viewArticles() {
        return view("admin/viewArticles");
    }

    public function viewSingleArticle($id) {
        return view("admin/viewSingleSection", ["section_id" => $id]);
    }

    public function addArticle() {
        return view('admin/addArticle');
    }
    

    // Admin Signal Provider Functions
    public function viewSignalsProvider() {
        return view("admin/viewSignalsProvider");
    }

    public function viewSignalProvider($id) {
        return view("admin/viewSignalProvider", ["signalProvider_id" => $id]);
    }

    public function addSignalProvider() {
        return view('admin/addSignalProvider');
    }


    // Signal Provider Functions
    public function signalsProvider() {
        return view("signalsProvider/home");
    }

    public function signalsProviderLogin() {
        return view("signalsProvider/signin");
    }

    public function activateAccount($verifyToken) {
        return view("signalsProvider/verifyAccount", ["verifyToken" => $verifyToken]);
    }

    public function sp_accountVerification($verifyToken) {
        return view("signalsProvider/verifyAccount", ["verifyToken" => $verifyToken]);
    }

    // Signal Provider Functions
    public function userHome() {
        return view("user/home");
    }

    public function userLogin() {
        return view("user/signin");
    }

    public function signalSubscription() {
        return view("user/signalSubscription");
    }

}