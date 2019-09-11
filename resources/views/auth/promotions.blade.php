@extends('layouts.app')

@include('layouts.nav')

@section('content')

  <div class="container">
    <h1 class="mb-5 text-center">Raggiungi più clienti sponsorizza <strong>{{$house->title }}</strong> </h1>
    <section class="section-promotion col-lg-12 tex-center">
      <form class="col-md-6 col-lg-12" action="">
        @foreach ($promotions as $promotion)
        <div class="input-group col-lg-4 mb-2 ml-1">
          <input type="radio" name="radio_btn" value="{{$promotion->name}}"> 
          <span class="badge badge-pill badge-warning ml-2">{{ $promotion->name }}</span>
          <span class="price-style">{{ $promotion->price }}€</span>
          <strong class="ml-2"><i class="far fa-clock fa-2x mr-2"></i><span>{{ $promotion->duration }} ore</span><br></strong>
           {{-- link per visualizzare pagamenti --}}
          <button><a href="{{ route('show_payments', [$id = $house->id, $id_promo = $promotion->id]) }}">Paga</a></button>
        </div>
        @endforeach
      </form>
    </section>
  </div>

  {{-- <ul>
    <li><strong>id casa da promuovere: </strong>{{ $house->id }}</li>
  </ul> --}}
@endsection
