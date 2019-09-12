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

        // dd($features);
        // $features_house = DB::table('features')
        // ->join('feature_house', 'feature_house.feature_id', '=', 'features.id')
        // ->join('houses', 'feature_house.house_id', '=', 'houses.id')
        // ->where('address', 'like', '%'.$address.'%')->get();
        // dd($features[0]);
        $house_list = DB::table('houses')
            ->join('feature_house', 'feature_house.house_id', '=', 'houses.id')
            ->where('address', 'like', '%'.$address.'%')
            ->whereIn('feature_house.feature_id', $features)->get();

            dd($house_list);

        public function filter(Request $request)
        {
        $features = Feature::when($request->has('mark'), function($query) use ($request) {
            return $query->whereIn('device_mark', $request->mark); //Assuming you are passing an array of IDs
        })->get();

        return $features;
       }

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
