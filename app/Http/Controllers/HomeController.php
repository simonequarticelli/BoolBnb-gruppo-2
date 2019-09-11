<?php

namespace App\Http\Controllers;

use App\House;
use App\Message;
use App\Promotion;
use Illuminate\Http\Request;
use App\Mail\messageFromUser;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    /*per utilizzare questo controller devi essere autenticato
    tranne che per vedere la homepage e i dettagli delle case*/
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detailsHouseHome', 'storeMail']);
    }


    public function index()
    {
        $new_house = House::all();

        $house_promo = DB::table('houses')
            ->join('house_promotion', 'houses.id', '=', 'house_promotion.house_id')
            ->whereIn('house_promotion.promotion_id', [1, 2, 3])
            ->get();

        return view('home')->with([
            'new_house' => $new_house,
            'house_promo' => $house_promo
        ]);
    }

    public function detailsHouseHome(Request $request,  $id, $slug)
    {

        //dd($request->url());
        /* url corrente */
        $current_url = $request->url();
        
        
        /* da collection ad array */
        $array_sessione = session()->all();
        /* accedo all'url salvato nella sessione */
        //dd($array_sessione['url'],  $current_url);
        

        $house = House::find($id);
        //dd($house['user_id']);

        
        

        // if (Auth::user() == null || Auth::user() == true && !Auth::user()->HasRole('upra')) {

        //     $house->increment('view');

        // }elseif (!empty(Auth::user()->houses)) {

        //     /* recupero la fk user nella tabella case per capire di chi è la casa */
        //     $houses_user_collection = Auth::user()->houses;
        //     $houses_user_array = $houses_user_collection->all();
        //     foreach ($houses_user_array as $house_user) {

        //         $user_id_table_houses = $house_user->user_id;

        //     }

        //     // dd($user_id_table_houses, Auth::user()->id, Auth::user()->HasRole('upra'));
        //     // dd($houses_user_array['user_id']);
        //     // dd(Auth::user()->HasRole('upra'));

        //     //dd($user_id_table_houses == Auth::user()->id, Auth::user()->HasRole('upra'), !($house['user_id'] == $user_id_table_houses));

        //     if (Auth::user()->HasRole('upra') && !($house['user_id'] == $user_id_table_houses)) {

        //         $house->increment('view');

        //     }

        // }


        return view('single_house', compact('house'));

    }

    public function storeMail(Request $request)
    {
        /*validazione dei dati*/
        $validateData = $request->validate([

            'email' => 'required|string|max:100',
            'subject' => 'string|max:100',
            'message' => 'required|string|max:255'

        ]);

        $data = $request->all();

        // dd($data);

        $email_to = $data['email_proprietario'];


        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();


        /* invia la mail al proprietario */
        Mail::to($email_to)->send(new messageFromUser($new_message));

        /* redirect alla pagina precedente e passo nella session alert */
        return redirect()->back()->with('alert', 'Email inviata!');


    }

}
