{{-- @php
  dd($messages)
@endphp --}}

@extends('layouts.app')

@include('layouts.nav')
@section('content')
  <section class="message_box_container">
   <div class="container">
      <table class="table">
          <thead>
            <tr>
              {{-- <th><i class="fas fa-trash"></i></th>
              <th></th> --}}
            </tr>
             @if ($messages->count() > 0)
          </thead>
          <tbody>
            @foreach ($messages as $key => $message)
              <tr>
                  <td><input type="checkbox" name="" value="{{$messages}}"></td>
                  <td class="info-message clickable" data-toggle="collapse" data-target="#accordion{{$key}}" aria-expanded="false" aria-controls="collapseExample" >
                    <div  class="col-lg-10">
                      <h5>{{$message->email}}</h5>
                      <p>{{$message->subject}}</p>
                    </div>
                    <div class="hour-received">
                        <small><p><strong>Ricevuto </strong></p>{{$message->created_at}}</small>
                    </div>
                  </td>
              </tr>
              <tr>
                  <td class="message-box" colspan="3">
                      <div id="accordion{{$key}}" class="collapse">
                        <p class="card card-body">{{$message->message}}</p>
                      </div>
                  </td>
              </tr>
            @endforeach
          </tbody>
        @endif
      </table>
    </div>
  </section>


@endsection
