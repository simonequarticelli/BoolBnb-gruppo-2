<?php

namespace App\Http\Controllers;

use App\Role;
use App\House;
use App\Feature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;

class HouseController extends Controller
{
    public function __construct() {
        /*per usare questo controller l'utente deve essere autenticato con assegnato il ruolo di "upra"
        tranne che per accedere alle funzioni create e store*/
        $this->middleware('role:upra')->except(['create', 'store']);
    }

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
           // passare a sync l'arrey delle checkbox (dopo aver fatto il save)
            $new_house->features()->sync($data['feature']);
        }
        

        return redirect()->route('home');

    }


    public function show(House $house)
    {
        //
    }


    public function edit(House $house)
    {
        //
    }


    public function update(Request $request, House $house)
    {
        //
    }


    public function destroy(House $house)
    {
        //
    }
}
