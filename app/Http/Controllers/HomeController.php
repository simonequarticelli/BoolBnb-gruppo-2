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

        /* query per case con promo */
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
        
        $house = House::find($id);
        //dd($house['user_id']);

        // ---------------------controllo url in array di sessione------------------------------
        $array_sessione = session()->all();
        $array_url = $array_sessione['url_visited'];
        

        /*se 'lutente non è autenticato e url non è presente nell'array di sessione*/
        if (Auth::user() == null && !in_array(url()->current(), $array_url)) {

            echo 'no auth - url no presente';
            $house->increment('view');

        /*se è autenticato senza casa e url non è presente nell'array di sessione*/
        }elseif (Auth::user() == true && !Auth::user()->HasRole('upra') && !in_array(url()->current(), $array_url) ) {
            
            
            echo 'auth senza casa url no presente';
            $house->increment('view');
       

        }elseif (!empty(Auth::user()->houses)) {

            /* recupero la fk user nella tabella case per capire di chi è la casa */
            $houses_user_collection = Auth::user()->houses;
            $houses_user_array = $houses_user_collection->all();
            foreach ($houses_user_array as $house_user) {

                $user_id_table_houses = $house_user->user_id;

            }

            // dd($user_id_table_houses, Auth::user()->id, Auth::user()->HasRole('upra'));
            // dd($houses_user_array['user_id']);
            // dd(Auth::user()->HasRole('upra'));

            //dd($user_id_table_houses == Auth::user()->id, Auth::user()->HasRole('upra'), !($house['user_id'] == $user_id_table_houses));

            /*non è proprietario della casa e url non è presente nell'array di sessione*/
            if (!($house['user_id'] == $user_id_table_houses) && !in_array(url()->current(), $array_url) ) {

                echo 'upra - no proprietario - url no presente';
                $house->increment('view');
             
            }

        }


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
