@extends('layouts.app')

@section('content')
  {{-- @php
      dd(Auth::user()->hasRole('upra'));
  @endphp --}}
  <div class="content_home">
    @include('layouts.nav_home')
    <section class="first_section">
      <div class="container">
          <div class="col-lg-4">
            <div class="booking">
              <h2>Prenota alloggi e attività unici.</h2>
              <div class="where">
                <strong>DOVE</strong>
              </div>
              <div class="input-group mt-2 mb-2">
                <input type="text" class="form-control" placeholder="Ovunque" aria-label="Username" aria-describedby="basic-addon1">
              </div>
              <div class="button_search">
                <a href="#" class="btn btn-info mt-2 pt-2 pb-2 pl-3 pr-3" role="button">Cerca</a>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
  <section class="featured_apartments">
    <div class="container">
      <h3>Appartamenti in evidenza</h3>
      <div class="col-lg-12 first-card-container card-container-flex">
        <div class="card col-lg-3 col-sm-12">
          <img src="{{asset('images/app-test.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="{{ route('details') }}" class="btn btn-danger">Go somewhere</a>
          </div>
        </div>

        <div class="card col-lg-3 col-sm-12">
          <img src="{{asset('images/app-test.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
          </div>
        </div>

        <div class="card col-lg-3 col-sm-12">
          <img src="{{asset('images/app-test.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
          </div>
        </div>
      </div>

      <div class="col-lg-12 card-container-flex">
        <div class="card col-lg-3 col-sm-12">
          <img src="{{asset('images/app-test.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
          </div>
        </div>

        <div class="card col-lg-3 col-sm-12">
          <img src="{{asset('images/app-test.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
          </div>
        </div>

        <div class="card col-lg-3 col-sm-12">
          <img src="{{asset('images/app-test.jpg')}}" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-danger">Go somewhere</a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
