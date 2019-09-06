@extends('layouts.app')

@section('content')
  @include('layouts.nav')

  <section class="upra-section mt-3 mb-5">
    <div class="container d-flex flex-wrap">
      <h1 class="col-lg-12 text-center mb-3">I tuoi appartamenti</h1>
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
                                <i class="fas fa-door-open mr-1"></i>{{ $feature->name }}
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
                  <a class="btn btn-primary mr-2" href="{{ route('house.edit', $house->id) }}">Modifica</a>
                  <a href="{{ route('promotions', [$house->id, $house->slug]) }}" class="btn btn-warning mr-2">Promuovi</a>
                  <form action="{{ route('house.destroy', $house->id) }}" method="post">
                    <input type="submit" class="btn btn-danger mr-2" name="" value="Cancella">
                    @method('DELETE')
                    @csrf
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

@endsection
