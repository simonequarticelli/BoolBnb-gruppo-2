<?php

namespace App\Http\Controllers;

use App\House;
use App\Feature;
use App\FilterAjax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterAjaxController extends Controller
{

    public function index()
    {
        $address = $_GET['address'];

        // $event_features = $_GET['types'];
        // $features = (json_decode(stripslashes($event_features)));
        //dd($features);

        $house_list = DB::table('houses')
            ->where('address', 'like', '%'.$address.'%')->get();

        if ($house_list->count() > 0) {
            return response()->json([
                'success' => true,
                'result' => $house_list
            ]);
        }else {
            return response()->json([
                'success' => false,
                'result' => 'houses not found'
            ]);
        }

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
