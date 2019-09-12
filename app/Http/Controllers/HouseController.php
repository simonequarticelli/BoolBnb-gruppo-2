<?php

namespace App\Http\Controllers;

use Session;
use App\Role;
use App\House;
use App\Feature;
use App\Promotion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    public function __construct() {
        /*per usare questo controller l'utente deve essere autenticato con assegnato il ruolo di "upra"
        tranne che per accedere alle funzioni create e store*/
        $this->middleware('role:upra')->except(['create', 'store', 'search']);
    }

    /*----------------filter------------------------------------------*/
    public function search(Request $request)
    {

        /*validazione dei dati*/
        $validateData = $request->validate([
            'address_home' => 'required|string|max:100'

            /*espressione regolare => 'not_regex:/^.+$/i'*/
            // 'name' => 'regex:/^[a-zA-Z ]+$/'
            // name' => 'regex:/^[A-Za-z\s-_]+$/';

        ]);

        $features = Feature::all();

        $data = $request->all();
        //dd($data);

        $address_home = $data['address_home'];

        //dd($address_home);

        $house_list = DB::table('houses')
            ->where('address', 'like', '%'.$address_home.'%')->get();

        //dd($house_list);

        /*oltre i dati passo alla view anche l'input dell'utente*/
        return view('search_house')->with([
            'house_list' => $house_list,
            'address_home' => $address_home,
            'features' => $features
        ]);
    }
    /*-----------------------------------------------------------------*/

    public function index()
    {
        $houses_user = Auth::user()->houses;
        
        return view('auth.personal_page_upra', compact('houses_user'));
    }


    public function create()
    {
        $features = Feature::all();
        return view('auth.add_house', compact('features'));
    }


    public function store(Request $request)
    {

        // dd(Auth::user()->id);

        /*validazione dei dati*/
        $validateData = $request->validate([
            'title' => 'required|max:100',
            'n_beds' => 'required|integer|between:1, 50',
            'n_wc' => 'required|integer|between:1, 50',
            'mq' => 'required|integer|between:1, 1000',
            'address' => 'required|max:100',
            'img' => 'required|image'

            /*espressione regolare => 'not_regex:/^.+$/i'*/

        ]);

        if(!Auth::user()->hasRole('upra')){
          /*assegno upra all'utente*/
          $user = Auth::user();
          //dd($user);

          // Initiate the 'member' Role
          $member = Role::where( 'name', '=', 'upra' )->first();

          // Give each new user the role of 'member'
          $user->attachRole($member);
        }

        $data = $request->all();
        //dd($data);

        $data['slug'] = Str::slug($data['title']);
        $new_house = new House();
        $new_house->user_id = Auth::user()->id;
        $img = Storage::put('upload_file', $data['img']);
        $new_house->img = $img;
        $new_house->fill($data);
        $new_house->save();

        if (!empty($data['feature'])) {
           // passare a sync l'array delle checkbox (dopo aver fatto il save)
            $new_house->features()->sync($data['feature']);
        }

        return redirect()->route('home');

    }

    /*funzione relativa alla visualizzazione delle promo*/
    public function showPromotions($id, $slug)
    {
        $promotions = Promotion::all();
        $house = House::find($id);
        return view('auth.promotions')->with([
            'promotions' => $promotions,
            'house' => $house
        ]);
    }





    public function showPayments($id, $promo_id)
    {
        $house = House::find($id);

        $promo = Promotion::find($promo_id);
        
        return view('auth.payments')->with([
            'house' => $house,
            'promo' => $promo
        ]);
    }






    
    public function showStatistics()
    {
        // assegno all'id che mi arriva l'id dell'utente che è connesso attualmente
        $id = Auth::user()->id;

        // controllo che l'url, o meglio la parte finale sia corrispondente all'utente che è connesso
        if(!str_contains(url()->current(), '/statistics/user/'.$id)){
          abort('404');
        }

         /* query per avere i messaggi dell'utente corrente */
         $messages = DB::table('messages')
            ->join('houses', 'house_id', '=', 'houses.id')
            ->where('user_id', Auth::user()->id)
            ->get();

        //dd($messages);


        /* scorro collection per pushare nomi casa nell'array */
        // $houses_user_collection = Auth::user()->houses;
        // foreach ($houses_user_collection as $house) {

        //     $chart_houses[] = $house['title'];

        // }

        /* array con nomi case */
        //dd($chart_houses);


        /* conteggio messaggi utente */
        $count_messages = $messages->count();


        /* query per avere la somma delle view dell'utente corrente */
        $count_view = DB::table('houses')
            ->where('user_id', Auth::user()->id)
            ->sum('houses.view');


        return view('auth.statistics_user')->with([

            'count_messages' => $count_messages,
            'count_view' => $count_view,
            // 'chart_houses' => $chart_houses

        ]);
    }

    public function edit(House $house)
    {
        // controllare che l'utente possa modificare solo i suoi appartamenti
        $apartments = \Auth::user()->houses->pluck('id')->all();
        // dd($apartments);
        // se l'utente modifica l'url e vuole modificare un altro appartamento lo mando in 404
        if(!in_array($house->id, $apartments)){
          abort(404);
        }
        $features = Feature::all();
        $data = ['house' => $house, 'features' => $features];
        return view('auth.edit', $data);
    }


    public function update(Request $request, House $house)
    {
      /*validazione dei dati*/
      $validateData = $request->validate([
          'title' => 'required|max:100',
          'n_beds' => 'required|integer|between:1, 50',
          'n_wc' => 'required|integer|between:1, 50',
          'mq' => 'required|integer|between:1, 1000',
          'address' => 'required|max:100',
          'img' => 'image'
          /*espressione regolare => 'not_regex:/^.+$/i'*/
      ]);

      $data = $request->all();
      // dd($data);
      $data['slug'] = Str::slug($data['title']);
      if (!empty($data['img'])) {

        $img = Storage::put('upload_file', $data['img']);
        $house->img = $img;

      }

      if(!empty($data['feature'])){
        $house->features()->sync($data['feature']);
      } else {
        $house->features()->sync([]);
      }

      $house->update($data);

      return redirect()->route('house.index');

    }


    public function destroy(House $house)
    {

        // controllare che l'utente possa modificare solo i suoi appartamenti
        $apartments = \Auth::user()->houses->pluck('id')->all();
        // se l'utente modifica l'url e vuole modificare un altro appartamento lo mando in 404
        if(!in_array($house->id, $apartments)){
          abort(404);
        }
        $house->features()->sync([]);
        $house->delete();

        return redirect()->back()->with('alert', 'Casa eliminata!');

    }


}
