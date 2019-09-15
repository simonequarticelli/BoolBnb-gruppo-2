@php
  use Illuminate\Support\Carbon;
 session()->put('badge_upra');
@endphp

@extends('layouts.app')

  @include('layouts.nav')

@section('content')

  @if (session('alert'))
    <!--SWEETALERT2-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
      Swal.fire({
        position: 'center',
        type: 'success',
        title: '{{ session('alert') }}',
        showConfirmButton: false,
        timer: 2500
      })
    </script>
  @endif

  <h1 class="col-lg-12 text-center mb-5">I tuoi appartamenti</h1>
  <section class="upra-section mt-3 mb-5">
    <div class="container d-flex flex-wrap">
      @if($houses_user->count() > 0)
        @foreach ( $houses_user as $house )
          <div class="card mb-12">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="{{ asset('storage/' . $house->img) }}" class="card-img" alt="immagine {{ $house->title }} ">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $house->title }}</h5>
                  <p class="card-text">L'appartamento si trova in {{ $house->address }} ed ha una grandezza di {{ $house->mq }} mq, con {{ $house->n_beds }} letti e {{ $house->n_wc }} bagni.</p>
                  @if ($house->features->count() > 0)
                    <h3>Servizi</h3>
                    @php
                      $features_house = $house->features
                    @endphp
                    <ul>
                      @foreach ($features_house as $feature)
                          <li class="list-unstyled">
                            @switch($feature->name)
                              @case('wifi')
                                <i class="fas fa-wifi mr-1"></i>{{ $feature->name }}
                                  @break
                              @case('posto macchina')
                                <i class="fas fa-car mr-1"></i>{{ $feature->name }}
                                  @break
                              @case('piscina')
                                <i class="fas fa-swimming-pool mr-1"></i>{{ $feature->name }}
                                @break
                              @case('sauna')
                                <i class="fas fa-hot-tub mr-1"></i>{{ $feature->name }}
                                @break
                              @case('vista mare')
                                <i class="fas fa-water mr-1"></i>{{ $feature->name }}
                                @break
                              @default
                            @endswitch
                          </li>
                      @endforeach
                    </ul>
                    @else
                    <h3>Servizi non presenti</h3>
                    <ul class="mb-2">
                      <li class="list-unstyled">
                        <i class="fas fa-frown fa-2x"></i>
                      </li>
                    </ul>
                  @endif
                  <div class="btn-group">

                    {{-- ricerco promozione corrente + controllo durata promo--}}
                    @php

                      $coll = $house->promotions;
                      //dd($coll);
                      $array = $coll->toArray();
                      foreach ($array as $promo) {
                        $created_promo = $promo['pivot']['created_at'];
                      }

                      $house_current_coll = $house->promotions;
                      foreach ($house_current_coll as $current_promo) {
                        $promo_now = $current_promo->name;
                        $promo_duration = $current_promo->duration;
                        $end_promo = Carbon::now()->subSecond($promo_duration)->toDateTimeString();
                        //dd($promo_now,  $promo_duration, $created_promo, $end_promo);
                      }

                    @endphp

                    

                    {{-- controllo se la casa è in promo --}}
                    @if ($house->promotions->count() > 0 && $created_promo > $end_promo) 
                      <a href="{{ route('promotions', [$house->id, $house->slug]) }}" class="btn btn-warning mr-2 disabled">{{ $promo_now }}</a>
                    @else
                      <a class="btn btn-primary mr-2" href="{{ route('house.edit', $house->id) }}">Modifica</a>
                      <a href="{{ route('promotions', [$house->id, $house->slug]) }}" class="btn btn-warning mr-2">Promuovi</a>
                      <form action="{{ route('house.destroy', $house->id) }}" method="post">
                        <input type="submit" class="btn btn-danger mr-2" name="" value="Cancella">
                        @method('DELETE')
                        @csrf
                      </form>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <h1 class="no-home">Non hai nessuna casa</h1>
        <a class="btn btn-danger" href="{{ route('home') }}">Torna alla home</a>
      @endif
    </div>
  </section>

@endsection
