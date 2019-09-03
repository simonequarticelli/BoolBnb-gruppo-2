{{-- pagina relativa alla visualizzazione del singolo appartamento --}}
@extends('layouts.app')

@section('content')
  @include('layouts.nav')

  {{-- header singolo appartamento include inizialmente una immagine è una mappa --}}
  <div class="container house-graph">
    <div class="col-lg-12 img-house">
      {{-- code --}}
    </div>
  </div>
  <section class="first-section-house">
    <div class="container house-first-section mt-5">
      <div class="col-lg-8 house-desc">
        <h1>{{ $house->title }}</h1>

        {{-- @php
          dd($house->features->count() > 0);
        @endphp --}}

        {{-- controllo che la casa abbia i servizi --}}
        @if ($house->features->count() > 0)
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
                      <i class="fas fa-door-open mr-3"></i>{{ $feature->name }}
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
          <form class="" action="index.html" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">La tua Mail</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"

              @if (Auth::user())
              value="{{ Auth::user()->email }}"
              @endif
              placeholder="Inserisci la tua mail">

            </div>
            <div class="form-group message-form">
              <label for="exampleFormControlTextarea1">Il tuo messaggio</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"  placeholder="Inserisci il tuo messaggio"></textarea>
            </div>
          <button type="submit" class="btn btn-primary">Invia</button>
          </form>
      </div>
    </div>
  </section>

  {{-- <section class="second-section-house">
    <div class="container house-second-section">

    </div>
  </section> --}}

  <div id="map-example-container-paris"></div>
<input type="search" id="input-map-paris" class="form-control" 
placeholder="Find a street in Paris, France. Try &quot;Rivoli&quot;" value="{{ $house->address }}"/>
{{-- @php
    //dd($house->latitude);
    dd($house->longitude)
@endphp --}}
<style>
  #map-example-container-paris {
    height: 300px
  }
</style>

<script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
<script>
  var lat = Number('{{ $house->latitude }}');
  var lng = Number('{{ $house->longitude }}');
  console.log(lat);
  console.log(lng);
  
  
(function() {
  var latlng = {
    lat:  lat.toFixed(6),
    lng:  lng.toFixed(6)
  };

  var placesAutocomplete = places({
    appId: 'plHY9UTOIKXX',
    apiKey: 'b1c9ff4767e9c175969b8e601ced129d',
    container: document.querySelector('#input-map-paris'),
    templates: {
      suggestion: function(suggestion) {
        return '<i class="flag ' + suggestion.countryCode + '"></i> ' +
          suggestion.highlight.name;
      }
    }
  }).configure({
    aroundLatLng: lat + ',' + lng, // Paris latitude longitude
    aroundRadius: 10 * 1000, // 10km radius
    type: 'address'
  });

  var map = L.map('map-example-container-paris', {
    scrollWheelZoom: true,
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

  map.setView(new L.LatLng(lat, lng), 12);
  map.addLayer(osmLayer);

  placesAutocomplete.on('suggestions', handleOnSuggestions);
  placesAutocomplete.on('cursorchanged', handleOnCursorchanged);
  placesAutocomplete.on('change', handleOnChange);

  function handleOnSuggestions(e) {
    markers.forEach(removeMarker);
    markers = [];

    if (e.suggestions.length === 0) {
      map.setView(new L.LatLng(lat, lng), 12);
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
    map.setView(new L.LatLng(lat, lng), 12);
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
