@extends('layouts/app-form')

@include('layouts.nav')

<div class="container">
    <form action="{{ route('house.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label>Titolo</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror"
            placeholder="Testo descrittivo" name="title" required max="100" value="{{ old('title') }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group">
            <label>Letti</label>
            <input type="number" class="form-control @error('n_beds') is-invalid @enderror"
            placeholder="Numero letti" name="n_beds" required min="1" max="50" value="{{ old('n_beds') }}">
            @error('n_beds')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Wc</label>
            <input type="number" class="form-control @error('n_wc') is-invalid @enderror"
            placeholder="Numero bagni" name="n_wc" required min="1" max="50" value="{{ old('n_wc') }}">
            @error('n_wc')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Mq</label>
            <input type="number" class="form-control @error('mq') is-invalid @enderror"
            placeholder="Metri quadrati" name="mq" required min="10" max="1000" value="{{ old('mq') }}">
            @error('mq')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        @foreach ( $features as $feature )
           {{-- checkbox per servizi aggiuntivi --}}
                <div class="input-group-prepend mb-3 d-inline-block">
                    <div class="input-group-text">
                        <label class="m-0">
                            <input type="checkbox" name="feature[]" value="{{ $feature->id }}"
                            {{ in_array($feature->id, old('feature', array() )) ? 'checked' : ''}}>
                            {{ $feature->name }}
                        </label>
                    </div>
                </div>
        @endforeach

        <div class="form-group">
            <label>Indirizzo</label>
            <input name="address" type="search" id="address-input" placeholder="Indirizzo"
            required max="100" value="{{ old('address') }}"> {{-- test autocompletamento --}}
            <input id="lat" name="latitude" type="text">
            <input id="lng" name="longitude" type="text">
            @error('address')
                <span class="invalid-tooltip" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Immagine</label>
            <input type="file" name="img" class="form-control-file @error('img') is-invalid @enderror">
            @error('img')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Crea</button>

    </form>

</div>
