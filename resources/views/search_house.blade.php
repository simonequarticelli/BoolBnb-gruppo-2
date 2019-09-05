{{-- pagina relativa alla visualizzazione delle ricerche filtrate --}}
@extends('layouts.app')

@section('content')
  @include('layouts.nav_search')

  <section class="featured_apartments">
    <div class="container">
        <h3>Appartamenti trovati in <strong id="titolo-ricerca-case">{{ $address_home }}</strong></h3>
        @foreach ($house_list as $house )
        {{-- passo il parametro inserito nella ricerca dall'utente  --}}
        <div class="col-lg-12 first-card-container card-container-flex">
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
  </section>




  <!--HANDLEBARS-->
  <script class="card_template" type ="text/x-handlebars-template">
    <div class="col-lg-12 first-card-container card-container-flex">
        <div class="card col-lg-3 col-md-6 col-sm-12">
          <img src="@{{ asset('storage/' . {{ img }}) }}" class="card-img-top" alt="immagine {{ img_title }}">
          <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <a href="@{{ route('house_details', [$id = {{ id }}, $slug = {{ slug }}]) }}" class="btn btn-danger btn-card">Go somewhere</a>
          </div>
        </div>
    </div>
  </script>

  
    

@endsection