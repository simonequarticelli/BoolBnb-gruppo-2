{{-- pagina relativa alla visualizzazione delle ricerche filtrate --}}
@extends('layouts.app')

@section('content')
  @include('layouts.nav_search')

  <section class="featured_apartments">
    <div class="container">
        <h3>Appartamenti trovati in <strong id="titolo-ricerca-case">{{ $address_home }}</strong></h3>
        {{-- contenitore card ajax --}}
        <div id="container_card_ajax">
          @if (!$house_list->count()>0)
            <h1>Non ci sono case nella località selezionata!</h1>
          @endif
          <div class="col-lg-12 first-card-container card-container-flex">
            @foreach ($house_list as $house )
              {{-- passo il parametro inserito nella ricerca dall'utente  --}}
                <div class="card col-lg-3 col-md-6 col-sm-12">
                  <img src="{{ asset('storage/' . $house->img) }}" class="card-img-top" alt="immagine {{ $house->title }}">
                  <div class="card-body">
                    <h5 class="card-title">{{ $house->title }}</h5>
                    <a href="{{ route('house_details', [$id = $house->id, $slug = $house->slug]) }}" class="btn btn-danger btn-card">Go somewhere</a>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
    </div>
  </section>




  <!--HANDLEBARS-->
  <script class="card_template" type ="text/x-handlebars-template">
    <div class="col-lg-12 first-card-container card-container-flex">
      <div class="card col-lg-3 col-md-6 col-sm-12">
        <img src="{{ url('storage/')}}/@{{img}}" class="card-img-top" alt="immagine @{{ img_title }}">
        <div class="card-body">
          <h5 class="card-title">@{{ title }}</h5>
          {{-- http://localhost:8000/house-details/41/casa2-torino --}}
        
        </div>
      </div>
    </div>
  </script>




@endsection
