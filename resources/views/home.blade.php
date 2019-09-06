@extends('layouts.app')

@section('content')

  {{-- @php
      // dd(Session());
  @endphp --}}
  {{-- @php
      dd(Auth::user()->hasRole('upra'));
  @endphp --}}
  <div class="content_home">
    @include('layouts.nav_home')
    <section class="first_section">
      <div class="container">
          <div class="col-xl-5 col-lg-12">
            <div class="booking">
              <h2>Prenota alloggi e attività unici.</h2>
              <div class="where">
                <strong>DOVE</strong>
              </div>
              <form action="{{ route('house.search') }}" method="POST">
                @csrf
                <div class="input-group mt-2 mb-2">
                  {{-- search with algolia --}}
                  <input type="search" id="home-address-input" placeholder="Ovunque" required>
                  <input name="address_home" id="search_homepage" type="text" hidden>
                </div>
                <div class="button_search">
                  <button type="submit" class="btn btn-danger mt-2 pt-2 pb-2 pl-3 pr-3" role="button">Cerca</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </section>
  </div>
  <section class="featured_apartments text-center mb-5">
    <div class="container">
      <h3>Appartamenti in evidenza</h3>
      <div class="col-lg-12 first-card-container card-container-flex mt-4">

        {{-- @php
            dd($new_house->all());
        @endphp --}}
        @foreach ($new_house as $house )
        <div class="card col-lg-3 col-md-6 col-sm-12">
            <img src="{{ asset('storage/' . $house->img) }}" class="card-img-top" alt="immagine {{ $house->title }}">
            <div class="card-body">
              <h5 class="card-title">{{ $house->title }}</h5>
              <h6 class="card-title">{{ $house->address }}</h6>
              {{-- @php
                  dd([$id = $house->id, $slug = $house->slug]);
              @endphp --}}
              <a href="{{ route('house_details', [$id = $house->id, $slug = $house->slug]) }}" class="btn btn-danger btn-card">Go somewhere</a>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>
@endsection
