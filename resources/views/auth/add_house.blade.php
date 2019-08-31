@extends('layouts/app-form')

@include('layouts.nav')

<div class="container w-25">
    <form action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label>Titolo</label>
            <input type="text" class="form-control" placeholder="Testo descrittivo" name="title">
        </div>
        
        <div class="form-group">
            <label>Letti</label>
            <input type="number" class="form-control" placeholder="Numero letti" name="n_beds">
        </div>

        <div class="form-group">
            <label>Wc</label>
            <input type="number" class="form-control" placeholder="Numero bagni" name="n_wc">
        </div>

        <div class="form-group">
            <label>Mq</label>
            <input type="number" class="form-control" placeholder="Metri quadrati" name="mq">
        </div>

        @foreach ( $features as $feature )
           {{-- checkbox per servizi aggiuntivi --}}
                <div class="input-group-prepend mb-3 d-inline-block">
                    <div class="input-group-text">
                        <label class="m-0">
                            <input type="checkbox" name="feature[]" value="{{ $feature->name }}">
                            {{ $feature->name }}
                        </label>
                    </div>
                </div> 
        @endforeach
        
        <div class="form-group">
            <label>Indirizzo</label>
            <input name="address" type="search" id="address-input" placeholder="Città e indirizzo">
            <input id="lat" name="longitude" type="text" hidden>
            <input id="lng" name="latitude" type="text" hidden>
        </div>
        
        <div class="form-group">
            <label>Immagine</label>
            <input type="file" name="img" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Crea</button>

    </form>

</div>