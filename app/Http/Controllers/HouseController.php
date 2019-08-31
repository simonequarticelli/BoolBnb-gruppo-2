<?php

namespace App\Http\Controllers;

use App\Role;
use App\House;
use App\Feature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    public function __construct() {
        /*per usare questo controller l'utente deve essere autenticato con assegnato il ruolo di "upra"*/
        $this->middleware('role:upra')->except('create');
    }

    public function index()
    {
        // fare query alloggi legati all'utente
    }


    public function create()
    {
        /*controllo se l'utente ha gia il ruolo "upra"*/
        if (Auth::user()->HasRole('upra')) {

            $features = Feature::all();

            return view('auth.add_house', compact('features'));
        }

        $user = Auth::user();
        //dd($user);

        // Initiate the 'member' Role
        $member = Role::where( 'name', '=', 'upra' )->first();

        // Give each new user the role of 'member'
        $user->attachRole($member);

        return $user;

        

    }


    public function store(Request $request)
    {
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

        $data = $request->all();
        //dd($data);

        $data['slug'] = Str::slug($data['title']);
        $new_house = new House();
        $new_house->user_id = Auth::user()->id;
        $img = Storage::put('upload_file', $data['img']);
        $new_house->img = $img; 
        $new_house->fill($data);
        $new_house->save();

        // passare a sync l'arrey delle checkbox (dopo aver fatto il save)
        $new_house->features()->sync($data['feature']);
        
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
