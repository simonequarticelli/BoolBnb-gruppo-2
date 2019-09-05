<?php

namespace App\Http\Controllers;

use App\House;
use App\FilterAjax;
use Illuminate\Http\Request;

class FilterAjaxController extends Controller
{
    
    public function index()
    {
        $features = $_GET['features'];
        
        //dd($features); 

        // $houses = House::all();
        
        return response()->json([
            'success' => true,
            'result' => $features
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        
    }

    
    public function show(FilterAjax $filterAjax)
    {
        //
    }

    
    public function edit(FilterAjax $filterAjax)
    {
        //
    }

    
    public function update(Request $request, FilterAjax $filterAjax)
    {
        //
    }

    
    public function destroy(FilterAjax $filterAjax)
    {
        //
    }
}
