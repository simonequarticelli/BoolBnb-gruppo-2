<h1>PAGINA DELLE PROMOZIONI</h1>
@foreach ($promotions as $promotion)
    <ul>
        <li><strong>nome: </strong>{{ $promotion->name }}</li>
        <li><strong>prezzo: </strong>{{ $promotion->price }}</li>
        <li><strong>durata: </strong>{{ $promotion->duration }}</li>
    </ul>
@endforeach
<ul>
    <li><strong>id casa da promuovere: </strong>{{ $house->id }}</li>
</ul>



    