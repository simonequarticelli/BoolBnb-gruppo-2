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

        $number_elements_array = count($features);

        $query_2 = DB::table('feature_house')
        ->join('houses', 'feature_house.house_id', '=', 'houses.id')
        ->select('houses.id', 'houses.img', 'houses.title', 'houses.address', DB::raw("COUNT(*) as matchedItems"))
        ->whereIn('feature_id', $features)
        ->groupBy('house_id')
        ->having('matchedItems', '=', $number_elements_array)
        ->get();

        if ($query_2->count() > 0) {
            return response()->json([
                'success' => true,
                'result' => $query
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
