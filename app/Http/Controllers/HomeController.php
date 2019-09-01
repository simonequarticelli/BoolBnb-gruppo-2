<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /*per utilizzare questo controller devi essere autenticato
    tranne che per vedere la homepage e i dettagli delle case*/
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'DetailsHouseHome']);
    }


    public function index()
    {
        return view('home');
    }

    public function DetailsHouseHome()
    {
        return view('single_house');
    }

}
