<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function getLogin(){
        return view('user.login');
    }

    function getRegister(){
        return view('user.register');
    }

    function getHome(){
        return "home page";
    }

    function getListProduct(){
        return "getListProduct";
    }
}
