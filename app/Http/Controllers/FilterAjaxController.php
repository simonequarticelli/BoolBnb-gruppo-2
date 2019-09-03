<?php

namespace App\Http\Controllers;

use App\FilterAjax;
use Illuminate\Http\Request;

class FilterAjaxController extends Controller
{
    
    public function index()
    {
        $houses = House::all();
        
        return response()->json([
            'success' => true,
            'result' => $houses
        ]);
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
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
