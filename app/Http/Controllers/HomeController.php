<?php

namespace App\Http\Controllers;

use App\House;
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
        $new_house = House::all();
        
        return view('home', compact('new_house'));
    }

    public function DetailsHouseHome($id, $slug)
    {   
        
        $house = House::find($id);

        return view('single_house', compact('house'));
         
    }

}
