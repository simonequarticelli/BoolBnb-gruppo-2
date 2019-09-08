
@extends('layouts.app')

@include('layouts.nav')
@section('content')

  @if (session('alert'))
    <!--SWEETALERT2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 3000
      })

      Toast.fire({
        type: 'success',
        title: '{{ session('alert') }}'
      })
    </script>
  @endif

  <section class="message_box_container">
   <div class="container">
      <table class="table">
          <thead>
            <tr>
            </tr>
             @if ($messages->count() > 0)
             <h1 class="col-lg-12 text-center mb-3">I tuoi messaggi</h1>
          </thead>
          <tbody>
            @foreach ($messages as $message)
              <tr>
                  <td class="info-message clickable" data-toggle="collapse" data-target="#accordion{{$message->id}}" aria-expanded="false" aria-controls="collapseExample" >
                    <div  class="col-lg-10">
                      <h6>Messaggio ricevuto per l'annuncio: {{$message->title}} in {{ $message->address }}</h6>
                      <h5>{{$message->email}}</h5>
                      <p>{{$message->subject}}</p>
                    </div>
                    <div class="hour-received mt-3">
                        <small><p><strong>Ricevuto </strong></p>{{$message->created_at}}</small>
                    </div>
                  </td>
                  <td>
                    <form action="{{route('messages.destroy',  $message->id) }}" method="post">
                      @method('DELETE')
                      @csrf
                         <th>
                           <input type="submit" class="btn btn-danger btn-lg mt-3" style="border-radius: 100%;" value="X">
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
            <a class="btn btn-danger" href="{{ route('home') }}">Torna alla home</a>
        @endif
      </table>
    </div>
  </section>
@endsection
