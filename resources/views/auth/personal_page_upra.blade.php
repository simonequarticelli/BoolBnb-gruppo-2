@extends('layouts.app')

@include('layouts.nav')

@section('content')


    <div class=" container d-flex">
      
  @foreach ( $houses_user as $house )
      <div class="card col-lg-6 mb-3 mr-2" style="max-width: 540px;">
        <div class="row no-gutters">
          <div class="col-md-4">
            <img src="{{ 'storage/' . $house->img }}" class="card-img" alt="immagine {{ $house->title }}">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{ $house->title }}</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <a href="#" class="btn btn-primary">Modifica</a>
              <p class="card-text"><small class="text-muted">Ultimo aggiornamento 3 minuti fa</small></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  @endforeach
@endsection
