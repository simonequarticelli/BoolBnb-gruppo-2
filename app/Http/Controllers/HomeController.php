<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    /*per utilizzare questo controller devi essere autenticato tranne che per vedere la home*/
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    
    public function index()
    {
        return view('home');
    }

    public function AddHouse() {
        return view('auth.add_house');
    }
}
