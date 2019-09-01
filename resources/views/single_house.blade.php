{{-- pagina relativa alla visualizzazione del singolo appartamento --}}
@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    {{-- header singolo appartamento include inizialmente una immagine è una mappa --}}
          <div class="container house-graph">
            <div class="col-lg-12 img-house">

            </div>
          </div>

          <div class="container house-info mt-5">
            <div class="col-lg-7 house-desc">
              <h1>Titolo appartemento</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                 sed do eiusmod tempor incididunt ut labore
                et dolore magna aliqua. Ut enim ad minim veniam.</p>
            </div>
            <div class="col-lg-5">
              <h3>Servizi</h3>
              <ul><i class="fas fa-wifi mr-3"></i>Wi-Fi</ul>
              <ul><i class="fas fa-car mr-3"></i>Posto Macchina</ul>
              <ul><i class="fas fa-door-open mr-3"></i>Portineria</ul>
              <ul><i class="fas fa-hot-tub mr-3"></i>Sauna</ul>
              <ul><i class="fas fa-water mr-3"></i>Vista Mare</ul>
            </div>
          </div>



@endsection
