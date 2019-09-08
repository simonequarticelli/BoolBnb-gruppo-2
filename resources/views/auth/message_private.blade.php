
@extends('layouts.app')

@include('layouts.nav')
@section('content')
  <section class="message_box_container">
   <div class="container">
      <table class="table">
          <thead>
            <tr>
            </tr>
             @if ($messages->count() > 0)
          </thead>
          <tbody>
            @foreach ($messages as $message)
              <tr>
                  <td><input type="checkbox" name="delete_msg[]" value=""></td>
                  <td class="info-message clickable" data-toggle="collapse" data-target="#accordion{{$message->id}}" aria-expanded="false" aria-controls="collapseExample" >
                    <div  class="col-lg-10">
                      <h6>Messaggio ricevuto per l'annuncio: {{$message->title}} in {{ $message->address }}</h6>
                      <h5>{{$message->email}}</h5>
                      <p>{{$message->subject}}</p>
                    </div>
                    <div class="hour-received">
                        <small><p><strong>Ricevuto </strong></p>{{$message->created_at}}</small>
                    </div>
                  </td>
                  <td>
                    <form action="{{route('messages.destroy',  $message->id) }}" method="post">
                      @method('DELETE')
                      @csrf
                         <th>
                           <input type="submit" class="btn btn-danger" value="">
                         </th>
                    </form>
                  </td>
              </tr>
              <tr>
                  <td class="message-box" colspan="3">
                      <div id="accordion{{$message->id}}" class="collapse">
                        <p class="card card-body">{{$message->message}}</p>
                      </div>
                  </td>
              </tr>
            @endforeach
          </tbody>
          @else
            <h1>Non hai nessun Messaggio</h1>
            <a class="btn btn-info" href="#">Torna alla home</a>
        @endif
      </table>
    </div>
  </section>


@endsection
