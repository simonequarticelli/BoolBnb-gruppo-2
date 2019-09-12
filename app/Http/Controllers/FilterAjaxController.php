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

        $event_features = $_GET['features'];
        $features = (json_decode(stripslashes($event_features)));
        //dd($features, $address);


        /*query address*/
        // $query_1 = DB::table('houses')
        //   ->where('address', 'like', '%'.$address.'%');

        $query_2 = DB::table('feature_house')
         ->Join('houses', 'feature_house.house_id', '=', 'houses.id')
         ->whereIn('feature_id', $features)
         ->get();



        if ($query_2->count() > 0) {
            return response()->json([
                'success' => true,
                'result' => $query_2
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
