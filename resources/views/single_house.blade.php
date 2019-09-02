{{-- pagina relativa alla visualizzazione del singolo appartamento --}}
@extends('layouts.app')

@section('content')
    @include('layouts.nav')

    @php
        // dd($house->features);
        $fetures_house = $house->features
    @endphp

    {{-- header singolo appartamento include inizialmente una immagine è una mappa --}}
          <div class="container house-graph">
            <div class="col-lg-12 img-house">
              
            </div>
          </div>
          <section class="first-section-house">
            <div class="container house-first-section mt-5">
              <div class="col-lg-8 house-desc">
                <h1>{{ $house->title }}</h1>
                <h3>Servizi</h3>
                @foreach ($fetures_house as $feature)
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
              </div>

              <div class="col-lg-4 form-house">
                <h3>Scrivi al proprietario</h3>
                 <form class="" action="index.html" method="post">
                   <div class="form-group">
                     <label for="exampleInputEmail1">La tua Mail</label>
                     <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ Auth::user()->email }}">
                   </div>
                   <div class="form-group">
                     <label for="exampleFormControlTextarea1">Il tuo messaggio</label>
                     <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                   </div>
                  <button type="submit" class="btn btn-primary">Invia</button>
                 </form>
              </div>
            </div>
          </section>

          <section class="second-section-house">
            <div class="container house-second-section">
              <div class="search-map col-lg-12 col-sm-12">

              </div>
            </div>
          </section>





@endsection
