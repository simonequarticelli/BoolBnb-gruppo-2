<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct() {

        $this->middleware('role:upra');
    }

    public function index()
    {
        /* query per avere i messaggi dell'utente corrente */
        $messages = DB::table('houses')
            ->join('messages', 'houses.id', '=', 'messages.house_id')
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('messages.created_at', 'DESC')
            ->get();

        /* conteggio messaggi utente */
        // $messages->count();
        return view('auth.message_private', compact('messages'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

    }


    public function show(Message $message)
    {
        //
    }


    public function edit(Message $message)
    {
        //
    }


    public function update(Request $request, Message $message)
    {
        //
    }


    public function destroy(Message $message)
    {
      $message->delete();
      return redirect()->route('house.index');
    }
}
