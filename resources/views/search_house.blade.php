{{-- pagina relativa alla visualizzazione delle ricerche filtrate--}}
@extends('layouts.app')

@include('layouts.nav_search')

@section('content')

  <section class="featured_apartments">
    <div class="container">
      <h3>Appartamenti trovati in <strong id="titolo-ricerca-case">{{ $address_home }}</strong></h3>
      {{-- container card ajax --}}
      <div id="container_card_ajax" class="mb-5">
        {{-- content ajax --}}
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
