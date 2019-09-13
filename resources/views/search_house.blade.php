{{-- pagina relativa alla visualizzazione delle ricerche filtrate --}}
@extends('layouts.app')

@section('content')
  @include('layouts.nav')
  <section class="featured_apartments">
    <div class="container">
      <div class="search-and-button-container">
        <input class="form-control" id="address-input-search" type="search" placeholder="Search" aria-label="Search" value="{{ old('address') }}">
        <button class="btn btn-danger my-2 my-sm-0 mr-3" id="btn_filter_api" role="button" type="submit">Cerca</button>
        @error('address')
            <span class="invalid-tooltip" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        {{-- input nascosto indirizzo --}}
        <input id="search_filter_page" name="address_api" type="text">
        {{-- input nascosto latitudine --}}
        <input id="lat" name="latitude" type="text">
        {{-- input nascosto longitudine --}}
        <input id="lng" name="longitude" type="text">
      </div>


      {{-- <ul class="navbar-nav mr-auto"> --}}
      <div class="filters-container mt-3">
        <form id="form">
          <ul class="d-flex align-items-center">
            @foreach ( $features as $feature )
            <li class="nav-item mr-3 list-unstyled">
            {{-- checkbox per servizi aggiuntivi --}}
              <label class="label-checkbox m-1">
                  <input class="features mr-1" type="checkbox" name="feature[]" value="{{ $feature->id }}"
                  {{ in_array($feature->id, old('feature', array() )) ? 'checked' : ''}}>
                  {{ $feature->name }}
              </label>
            </li class="nav-item mr-3 list-unstyled">
            @endforeach

            {{--  input range per ricerca a raggio --}}
            <li class="d-flex align-items-center">
              <label class="label-checkbox m-1 d-inline">
                Cerca nel raggio di:</label>
                <input type="range" name="weight" id="range_weight" value="20" min="20" max="100"
                oninput="range_weight_disp.value = range_weight.value">
                <output id="range_weight_disp">20</output>km
            </li>
          </ul>
        </form>


      </div>



        <h3>Appartamenti trovati in <strong id="titolo-ricerca-case">{{ $address_home }}</strong></h3>
        {{-- contenitore card ajax --}}
        <div id="container_card_ajax" class="mb-5">
          @if (!$house_list->count() > 0)
            <h1>Non ci sono case nella località selezionata!</h1>
          @else
              @foreach ($house_list as $house )
                {{-- passo il parametro inserito nella ricerca dall'utente  --}}
                <div class="card col-lg-3 col-md-6 col-sm-12">
                  <img src="{{ asset('storage/' . $house->img) }}" class="card-img-top" alt="immagine {{ $house->title }}">
                  <div class="card-body">
                    <h5 class="card-title">{{ $house->title }}</h5>
                    <h6 class="card-title">{{ $house->address }}</h6>
                    <a href="{{ route('house_details', [$id = $house->id, $slug = $house->slug]) }}" class="btn btn-danger btn-card">Maggiori info</a>
                  </div>
                </div>
            @endforeach
          @endif
        </div>
    </div>
  </section>




  <!--HANDLEBARS-->
  <script class="card_template" type ="text/x-handlebars-template">
    <div class="card col-lg-3 col-md-6 col-sm-12">
      <img src="{{ url('storage/')}}/@{{ img }}" class="card-img-top" alt="immagine @{{ img_title }}">
      <div class="card-body">
        <h5 class="card-title">@{{ title }}</h5>
        <h6 class="card-title">@{{ address }}</h6>
        <a href="http://localhost:8000/house/details/@{{ id }}/@{{ slug }}" class="btn btn-danger btn-card">Maggiori info</a>
      </div>
    </div>
  </script>




@endsection
