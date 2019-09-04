@extends('layouts.app')

@include('layouts.nav')

@section('content')

  <div class="container d-flex flex-wrap">

    @foreach ( $houses_user as $house )
        <div class="card col-lg-6 col-sm-12 col-md-6 mb-3 mr-2 pl-0 pr-0" style="max-width: 540px;">
          <div class="row no-gutters">
            <div class="col-md-4">
              <img src="{{ asset('storage/' . $house->img) }}" class="card-img" alt="immagine {{ $house->title }}">
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">{{ $house->title }}</h5>
                <a href="#" class="btn btn-primary">Modifica</a>
                <p class="card-text"><small class="text-muted">Ultimo aggiornamento 3 minuti fa</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
@endsection

