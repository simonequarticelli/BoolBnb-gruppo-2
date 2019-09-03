{{-- pagina relativa alla visualizzazione del singolo appartamento --}}
@extends('layouts.app')

@section('content')
  @include('layouts.nav')

  {{-- header singolo appartamento include inizialmente una immagine è una mappa --}}
  <div class="container house-map-container">
    <div class="img-house col-xl-7 col-lg-12 col-md-12 col-sm-12">
      {{-- code --}}
    </div>

    <div class="search-map col-xl-4 col-lg-12 col-md-12 col-sm-12">
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
@endsection
