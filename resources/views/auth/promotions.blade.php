@extends('layouts.app')

@include('layouts.nav')

@section('content')

  <div class="container">
    <h1 class="mb-5 text-center">Raggiungi più clienti sponsorizza <strong>{{$house->title }}</strong> </h1>
    <section class="section-promotion col-lg-12 tex-center data-toggle="modal" data-target="#exampleModal"">
      <form class="col-md-6 col-lg-12" action="">
        @foreach ($promotions as $promotion)
        <div class="input-group col-lg-4 mb-3 ml-2 col-span-10">
          <input type="radio" name="radio_btn" value="{{$promotion->name}}">
          <span class="badge badge-pill badge-warning">{{ $promotion->name }}</span>
          <span class="price-style">{{ $promotion->price }}€</span>
          <strong class="orario-promo ml-2">
            <i class="far fa-clock fa-2x"></i>
            <span>{{ $promotion->duration }} ore</span></strong>
          {{-- link per visualizzare pagamenti --}}
          <button class="btn btn-danger pay-button"><a href="{{ route('show_payments', [$id = $house->id, $id_promo = $promotion->id]) }}">Paga</a></button>
        </div>
        @endforeach
      </form>
    </section>
  </div>
  
@endsection
