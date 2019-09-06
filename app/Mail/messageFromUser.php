<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class messageFromUser extends Mailable
{
    use Queueable, SerializesModels;

    public $message;
    
    /* la classe di default si aspetta un parametro */
    public function __construct($new_message)
    {
        $this->message = $new_message;
    }

    /* invia la formattzione della view con al suo interno il messaggio da parte dell'utente*/
    public function build()
    {   
        return $this->from($this->message->email)->view('mails.new_message')->with([

            'messaggio' => $this->message

        ]);

    }
}
