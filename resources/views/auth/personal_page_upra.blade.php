@extends('layouts.app')

@include('layouts.nav')

@section('content')

  <div class="container d-flex flex-wrap">
    <h1 class="col-lg-12 text-center mb-3">I tuoi appartamenti</h1>
    @foreach ( $houses_user as $house )
        <div class="card col-lg-6 col-sm-12 col-md-6 mb-3 mr-2 pl-0 pr-0" style="max-width: 540px;">
          <div class="row no-gutters">
            <div class="col-md-5">
              <img src="{{ asset('storage/' . $house->img) }}" class="card-img" alt="immagine {{ $house->title }}">
            </div>
            <div class="col-md-7">
              <div class="card-body d-flex flex-lg-row flex-column justify-content-between">
                <h5 class="card-title">{{ $house->title }}</h5>
                <div class="btn-group flex-lg-column flex-row" role="" aria-label="">
                  <a href="#" class="btn btn-primary">Visualizza</a>
                  <a href="#" class="btn btn-primary">Modifica</a>
                  <a href="#" class="btn btn-danger">Elimina</a>
                </div>
              </div>
            </div>
          </div>
        </div>
    @endforeach
  </div>
    
@endsection
