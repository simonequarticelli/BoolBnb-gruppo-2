<?php

namespace App\Http\Controllers;

use App\House;
use App\Message;
use App\Promotion;
use Illuminate\Support\Carbon;
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

        foreach ($new_house as $house) {
          $coll = $house->promotions;

          $array = $coll->toArray();

          foreach ($array as $promo) {

            $promo_current = $promo['id'];

            //dd($promo_current);

            // $house_promo = DB::table('houses')
            //   ->join('house_promotion', 'houses.id', '=', 'house_promotion.house_id')
            //   ->where('house_promotion.created_at', '>', Carbon::now()->subSeconds(24)->toDateTimeString())
            //   ->orwhere('house_promotion.created_at', '>', Carbon::now()->subSeconds(72)->toDateTimeString())
            //   ->orwhere('house_promotion.created_at', '>', Carbon::now()->subSeconds(144)->toDateTimeString())

            /*query per il controllo della durata della promo*/
            $house_promo = DB::table('houses')
                ->join('house_promotion', 'houses.id', '=', 'house_promotion.house_id')
                ->where('house_promotion.created_at', '>', Carbon::now()->subHours($promo_current)->toDateTimeString())
                ->get();
          }
        }

        if (!empty($house_promo)) {
          return view('home')->with([
              'new_house' => $new_house,
              'house_promo' => $house_promo
          ]);
        }else {
          return view('home')->with([
              'new_house' => $new_house
          ]);
        }

    }

    public function detailsHouseHome(Request $request,  $id, $slug)
    {

        $house = House::find($id);
        //dd($house['user_id']);

        // ---------------------controllo url in array di sessione------------------------------
        $array_sessione = session()->all();
        $array_url = $array_sessione['url_visited'];

        //dd(session()->all());
        //dd(!in_array(url()->current(), $array_url));

        /*se url non è presente nell'array di sessione*/
        if(!in_array(url()->current(), $array_url)) {

            /*se 'lutente non è autenticato*/
            if (Auth::user() == null) {

                $house->increment('view');

            /*se è autenticato senza casa*/
            }elseif (Auth::user() == true && !Auth::user()->HasRole('upra')) {

                $house->increment('view');

            /*se l'utente ha le case*/
            }elseif (Auth::user()->houses->count() > 0) {

                /* recupero la fk user nella tabella case per capire di chi è la casa */
                $houses_user_collection = Auth::user()->houses;
                $houses_user_array = $houses_user_collection->all();
                foreach ($houses_user_array as $house_user) {

                    $user_id_table_houses = $house_user->user_id;

                }

                // dd($user_id_table_houses, Auth::user()->id, Auth::user()->HasRole('upra'));
                // dd($houses_user_array['user_id']);
                // dd(Auth::user()->HasRole('upra'));

                // dd(!($house['user_id'] == $user_id_table_houses) && !in_array(url()->current(), $array_url));

                /*non è proprietario della casa*/
                if (!($house['user_id'] == $user_id_table_houses)) {

                    $house->increment('view');

                }
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
