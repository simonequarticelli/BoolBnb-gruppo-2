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
        $address = DB::table('houses')
          ->where('address', 'like', '%'.$address.'%')
          ->get();

        /*query per filtrare le ricerche*/
        $number_elements_array = count($features);
        $filter = DB::table('feature_house')
         ->join('houses', 'feature_house.house_id', '=', 'houses.id')
         ->select('houses.id', 'houses.img', 'houses.title', 'houses.slug', 'houses.address',
         DB::raw("COUNT(*) as matchedItems"))
         ->whereIn('feature_id', $features)
         ->groupBy('house_id')
         ->having('matchedItems', '=', $number_elements_array)->get();





        if ($filter->count() > 0) {
            return response()->json([
                'success' => true,
                'result' => $filter
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
