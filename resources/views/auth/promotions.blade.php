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
              <span class="badge badge-pill badge-warning ml-2">{{ $promotion->name }}</span>
              <span class="price-style">{{ $promotion->price }}€</span>
              <strong class="ml-2"><i class="far fa-clock fa-2x mr-2"></i><span>{{ $promotion->duration }}<span>ore</span></span><br></strong>
              {{-- link per visualizzare pagamenti --}}
              <button class="btn btn-danger pay-button invisible"><a href="{{ route('show_payments', [$id = $house->id, $id_promo = $promotion->id]) }}">Paga</a></button>
            </div>

            @endforeach
          </form>
        </section>
    <ul>
        <li><strong>id casa da promuovere: </strong>{{ $house->id }}</li>
    </ul>
  </div>
@endsection
