{{-- pagina relativa alla visualizzazione delle ricerche filtrate --}}
@extends('layouts.app')

@include('layouts.nav_search')

@section('content')

  <section class="featured_apartments">
    <div class="container">
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
        <button class="btn btn-danger btn-card show_ajax">Maggiori info</button>
      </div>
    </div>
  </script>

@endsection
