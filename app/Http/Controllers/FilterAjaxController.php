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

        $lat = $_GET['lat'];
        $lng = $_GET['lng'];
        $range = $_GET['range'];

        //dd($features, $address, $lat, $lng, $range);

        /*query per filtrare le ricerche*/
        $number_elements_array = count($features);

        if(empty($features)){
            $query = DB::table('houses')
              ->where('houses.address', 'like', '%'.$address.'%')
              ->get();
          } else {
            $query = DB::table('feature_house')
             ->join('houses', 'feature_house.house_id', '=', 'houses.id')
             ->select('houses.id', 'houses.img', 'houses.title', 'houses.slug', 'houses.address',
                      DB::raw("COUNT(*) as matchedItems"))
             ->where('houses.address', 'like', '%'.$address.'%')
             ->whereIn('feature_id', $features)
             ->groupBy('house_id')
             ->having('matchedItems', '=', $number_elements_array)
             ->get();
          }

         // $data = $address->merge($filter);

        /*sostituisco 3956[miles] con 6371[km]
        /*query per determinare il raggio di ricerca*/
        $query2 = DB::select(DB::raw("
            SELECT loc.*,
            6371 * 2 * ASIN(SQRT(POWER(SIN(($lat-ABS(latitude)) * PI()/180/2),2)
            + COS($lat * PI()/180) * COS(ABS(latitude) * PI()/180) * POWER(SIN(($lng-longitude) * PI()/180/2),2))) AS distance
            FROM houses AS loc
            WHERE longitude BETWEEN ($lng-$range / ABS(COS(RADIANS($lat))*69)) AND ($lng+$range / ABS(COS(RADIANS($lat)) * 69))
            AND latitude BETWEEN ($lat-($range/69)) AND ($lat+($range/69))
            GROUP BY loc.id
            HAVING distance < $range
            ORDER BY distance ASC
            LIMIT 5
        "));

        // 6371
        // SELECT loc.*,
      	// 3956 * 2 * ASIN(SQRT(POWER(SIN((45.067700-ABS(latitude)) * PI()/180/2),2) + COS(45.067700 * PI()/180) * COS(ABS(latitude) * PI()/180) * POWER(SIN((7.682400-longitude) * PI()/180/2),2))) AS distance
      	// FROM houses AS loc
      	// WHERE longitude BETWEEN (7.682400-50 / ABS(COS(RADIANS(45.067700))*69)) AND (7.682400+20 / ABS(COS(RADIANS(45.067700)) * 69))
      	// AND latitude BETWEEN (45.067700-(50/69)) AND (45.067700+(50/69))
      	// GROUP BY loc.id
      	// HAVING distance < 50
      	// ORDER BY distance ASC
      	// LIMIT 5


          
        if (!empty($query)) {
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


    public function show($id)
    {
        $house = House::find($id);

        $features = $house->features;

        //dd($features);

        if (!empty($house)) {
            return response()->json([
              'success' => true,
              'result' => $house
            ]);
        }else {
          return response()->json([
            'success' => false,
            'error' => 'houses not found'
          ]);
        }

    }

}

