<?php

namespace App\Http\Controllers;

use App\House;
use App\Message;
use Illuminate\Http\Request;
use App\Mail\messageFromUser;
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

        return view('home', compact('new_house'));
    }

    public function detailsHouseHome($id, $slug) 
    {

        $house = House::find($id);

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

        //dd($data);

        $email_to = $data['email_proprietario'];

        $new_message = new Message();
        $new_message->fill($data);
        $new_message->save();

       
        /* invia la mail al proprietario */
        Mail::to($email_to)->send(new messageFromUser($new_message));

        
    }

}
