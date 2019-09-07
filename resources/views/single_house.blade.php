{{-- pagina relativa alla visualizzazione del singolo appartamento --}}
@extends('layouts.app')

@section('content')
  @include('layouts.nav')

  @if (session('alert'))
    <!--SWEETALERT2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
      Swal.fire({
        type: 'success',
        title: '{{ session('alert') }}',
        showConfirmButton: false,
        timer: 2500
      })
    </script>
  @endif

  {{-- header singolo appartamento include inizialmente una immagine è una mappa --}}
  <div class="container house-map-container">
    <div class="col-xl-7 col-lg-8 col-md-10 col-sm-12 no-padding">
      {{-- code --}}
      <img class="img-house" src="{{ asset('storage/' . $house->img) }}" class="card-img-top" alt="immagine {{ $house->title }}">
    </div>

    <div id="map" class="search-map col-xl-4 col-lg-8 col-md-10 col-sm-12">
      {{-- code --}}
    </div>
  </div>
  <section class="first-section-house">
    <div class="container house-first-section mt-5 pl-0">
      <div class="col-lg-8 house-desc">
        <h1>{{ $house->title }}</h1>
        <h4>{{ $house->address }}</h4>

        {{-- @php
          dd($house->features->count() > 0);
        @endphp --}}

        {{-- controllo che la casa abbia i servizi --}}
        @if ($house->features->count() > 0)
        <br>
          <h3>Servizi</h3>
          @php
            $features_house = $house->features
          @endphp
          @foreach ($features_house as $feature)
            <ul>
              <li class="list-unstyled">
                  @switch($feature->name)
                    @case('wifi')
                      <i class="fas fa-wifi mr-3"></i>{{ $feature->name }}
                        @break
                    @case('posto macchina')
                      <i class="fas fa-car mr-3"></i>{{ $feature->name }}
                        @break
                    @case('piscina')
                      <i class="fas fa-swimming-pool mr-3"></i></i>{{ $feature->name }}
                      @break
                    @case('sauna')
                      <i class="fas fa-hot-tub mr-3"></i>{{ $feature->name }}
                      @break
                    @case('vista mare')
                      <i class="fas fa-water mr-3"></i>{{ $feature->name }}
                      @break
                    @default
                  @endswitch
              </li>
            </ul>
          @endforeach
        @else
          <br>
          <h3>Servizi non presenti</h3>
          <ul>
            <li class="list-unstyled">
              <i class="fas fa-frown fa-3x"></i>
            </li>
          </ul>
        @endif
      </div>

      <div class="col-lg-4 form-house">
        <h3>Scrivi al proprietario</h3>
          <form action="{{ route('store_mail')}}" method="post">
            @csrf
            @if (Auth::user() == null)
            <!--controllo se l'utente è il proprietario, se lo è disabilito il form-->
            @elseif ($house->user_id == Auth::user()->id)
              <fieldset disabled>
            @endif

            <div class="form-group message-form">
              <label for="exampleInputEmail1">La tua Mail</label>
              <input required type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp"
              
              @if (Auth::user() == null)
                placeholder="Inserisci la tua mail"
              {{-- se l'utente non è il proprietario inserisco la sua mail nell'input--}}
              @elseif ($house->user_id != Auth::user()->id)
                value="{{ Auth::user()->email }}"
              {{-- controllo se l'utente è il proprietario, se lo è inserisco il placeholder --}}
              @elseif ($house->user_id == Auth::user()->id)
                placeholder="Inserisci la tua mail">
              @endif
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group message-form">
              <label for="exampleInputEmail1">Oggetto</label>
              <input type="text" name="subject" class="form-control" placeholder="Inserisci oggetto messaggio" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <div class="form-group message-form">
              <label for="exampleFormControlTextarea1">Il tuo messaggio</label>
              <textarea required class="form-control @error('message') is-invalid @enderror" name="message" id="exampleFormControlTextarea1" rows="3"  placeholder="Inserisci il tuo messaggio"></textarea>
              @error('message')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            
            {{-- @php
                dd($house->user_id);
            @endphp --}}
            <input type="text" name="email_proprietario" value="{{ $house->user->email }}" hidden>
            <input type="text" name="house_id" value="{{ $house->id }}" hidden>
            {{-- <input type="text" name="house_address" value="{{ $house->address }}" hidden> --}}

            
            <button
              @if (Auth::user() == null)
              {{-- controllo se l'utente è il proprietario, se lo è disabilito il bottone e l'hover --}}
              @elseif ($house->user_id == Auth::user()->id)
                class="btn btn-primary disabled" Style="pointer-events:none;"
              @endif
                type="submit" class="btn btn-primary">Invia</button>
          </form>
          
      </div>
    </div>
  </section>

  <!------------------------------------ALGOLIA-------------------------------------------->

  <input type="search"
  id="input-map"
  class="form-control no-vision"
  val="{{ $house->address }}"
  placeholder="{{ $house->address }}"/>

  <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
  <script>

    var lat = '{{ $house->latitude }}';
    var lng = '{{ $house->longitude }}';
    console.log(lat);
    console.log(lng);

  (function() {
    var latlng = {
      lat: lat,
      lng: lng
    };

    var placesAutocomplete = places({
      appId: 'plHY9UTOIKXX',
      apiKey: 'b1c9ff4767e9c175969b8e601ced129d',
      container: document.querySelector('#input-map')
    });

    var map = L.map('map', {
      scrollWheelZoom: false,
      zoomControl: true
    });

    var osmLayer = new L.TileLayer(
      'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        minZoom: 12,
        maxZoom: 18,
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
      }
    );

    var markers = [];

    map.setView(new L.LatLng(latlng.lat, latlng.lng), 17);
    map.addLayer(osmLayer);

    placesAutocomplete.on('suggestions', handleOnSuggestions);
    placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
    placesAutocomplete.on('change', handleOnChange);

    function handleOnSuggestions(e) {
      markers.forEach(removeMarker);
      markers = [];

      if (e.suggestions.length === 0) {
        map.setView(new L.LatLng(latlng.lat, latlng.lng), 12);
        return;
      }

      e.suggestions.forEach(addMarker);
      findBestZoom();
    }

    function handleOnChange(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            markers = [marker];
            marker.setOpacity(1);
            findBestZoom();
          } else {
            removeMarker(marker);
          }
        });
    }

    function handleOnClear() {
      map.setView(new L.LatLng(latlng.lat, latlng.lng), 12);
    }

    function handleOnCursorchanged(e) {
      markers
        .forEach(function(marker, markerIndex) {
          if (markerIndex === e.suggestionIndex) {
            marker.setOpacity(1);
            marker.setZIndexOffset(1000);
          } else {
            marker.setZIndexOffset(0);
            marker.setOpacity(0.5);
          }
        });
    }

    function addMarker(suggestion) {
      var marker = L.marker(suggestion.latlng, {opacity: .4});
      marker.addTo(map);
      markers.push(marker);
    }

    function removeMarker(marker) {
      map.removeLayer(marker);
    }

    function findBestZoom() {
      var featureGroup = L.featureGroup(markers);
      map.fitBounds(featureGroup.getBounds().pad(0.5), {animate: false});
    }
  })();
  </script>
@endsection
