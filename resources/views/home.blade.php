@extends('layouts.app')

@section('content')

  @php
    session()->push('url_visited', url()->current());
  @endphp
  {{-- @php
      dd(Auth::user()->hasRole('upra'));
  @endphp --}}
  <div class="content_home">
    @include('layouts.nav_home')
    <section class="first_section">
      <div class="container">
          <div class="col-xl-5 col-lg-12">
            <div class="booking">
              <h2>Ricerca alloggi e attività uniche.</h2>
              <div class="where">
                <strong>DOVE</strong>
              </div>
              <form action="{{ route('house.search') }}" method="POST">
                @csrf
                <div class="input-group mt-2 mb-2">
                  {{-- search with algolia --}}
                  <input type="search" id="home-address-input" placeholder="Inserisci località" required>
                  <input required name="address_home" id="search_homepage" type="text" hidden>
                </div>
                <div class="button_search">
                  <button id="search_home" type="submit" class="btn btn-danger mt-2 pt-2 pb-2 pl-3 pr-3" role="button">Cerca</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
  <section class="featured_apartments first-featured-apartments text-center mb-5">
    <div class="container">
      <h1 class="mb-5 pt-5">Appartamenti in evidenza</h1>
      <div class="col-lg-12 first-card-container card-container-flex mt-4">
        @php
          //dd(session()->all());
        @endphp
        @foreach ($house_promo as $house )
          <div class="card col-lg-3 col-md-6 col-sm-12">
            @if (session()->exists($house->slug))
            @else
              <h1><span class="badge" style="position: absolute; left: -20px; background-color: #f9ca24; color: white;">New</span></h1>
            @endif
              <img src="{{ asset('storage/' . $house->img) }}" class="card-img-top" alt="immagine {{ $house->title }}">
              <div class="card-body">
                <h5 class="card-title">{{ $house->title }}</h5>
                <h6 class="card-title">{{ $house->address }}</h6>
                {{-- @php
                    dd([$id = $house->id, $slug = $house->slug]);
                @endphp --}}
                <a href="{{ route('house_details', [$id = $house->id, $slug = $house->slug]) }}" class="btn btn-danger btn-card">Maggiori info</a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>


  {{-- SEZIONE TUTTI GLI APPARTAMENTI --}}
 <section class="featured_apartments text-center mb-5">
    <div class="container">
      <h1 class="mb-5 pt-5">Tutti gli appartamenti</h1>
      <div class="col-lg-12 first-card-container justify-content-md-around justify-content-start card-container-flex mt-4">
        {{-- @php
            dd($new_house->all());
        @endphp --}}
        @foreach ($new_house as $house )
        <div class="card col-lg-3 col-md-5 col-sm-12">
            <img src="{{ asset('storage/' . $house->img) }}" class="card-img-top" alt="immagine {{ $house->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $house->title }}</h5>
              <h6 class="card-title">{{ $house->address }}</h6>
              {{-- @php
                  dd([$id = $house->id, $slug = $house->slug]);
              @endphp --}}
              <a href="{{ route('house_details', [$id = $house->id, $slug = $house->slug]) }}" class="btn btn-danger btn-card">Maggiori info</a>
          </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
