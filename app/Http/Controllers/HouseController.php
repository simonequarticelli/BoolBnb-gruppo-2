<?php

namespace App\Http\Controllers;

use App\Role;
use App\House;
use App\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = $request->all();
        dd($data);
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
