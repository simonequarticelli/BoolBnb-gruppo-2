@extends('layouts.app')

@include('layouts.nav')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h3><strong>{{ $promo->name }}</strong> a soli <strong>{{ $promo->price }}€</strong> per il tuo annuncio: <strong>{{ $house->title }}</h3></strong>
        <div id="dropin-container"></div>
        <button class="btn btn-success" id="submit-button">Paga</button>
      </div>
    </div>
 </div>
 <div class="py-2"></div>

  {{-- -----------------BRAINTREE--------------------------- --}}

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script>

    var button = document.querySelector('#submit-button');

    braintree.dropin.create({
      authorization: "{{ Braintree_ClientToken::generate() }}",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('{{ route('payment.process', [$id = $house->id, $id_promo = $promo->id]) }}', {payload}, function (response) {
            if (response.success) {

              /* aggiungo alert di conferma */
              Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Pagamento avvenuto con successo!!',
                showConfirmButton: false,
                timer: 2500
              })

              /* ritardo il reidirizzamento alla home */
              setTimeout(function () {
                window.location.href = "/home"; 
              }, 2500);

            } else {

              // Swal.fire({
              //   type: 'error',
              //   title: 'Oops...',
              //   text: 'Pagamento rifiutato!',
              // })


            }
          }, 'json');
        });
      });
    });

  </script>




@endsection