<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Exists;

class UserController extends Controller
{
    // how to call/route controller
    function getUser(){
        return "Anubhav Srivastav";
    }

    // how to add data with controller
    function getuser2($name){
        return "Hello $name";
    }

    // how to call a view with controller
    function getUserView(){
        return view('getuser');
    }

    // How to call a view in nested folder
    function getNested(){
        return view('admin.login');
    }
    function checkview(){
        if(View::exists('admin.signin')){
            return view('admin.signin');
        }
        else{
            echo "no view found";
        }

}
}
