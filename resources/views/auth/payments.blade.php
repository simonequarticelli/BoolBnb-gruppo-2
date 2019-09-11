@extends('layouts.app')

@include('layouts.nav')
@section('content')


<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="dropin-container"></div>
        <button class="btn btn-success" id="submit-button">Request payment method</button>
      </div>
    </div>
 </div>

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

              Swal.fire(
                'Good job!',
                'You clicked the button!',
                'success'
              )

            } else {

              Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Pagamento rifiutato!',
                footer: '<a href>Why do I have this issue?</a>' // DA CHIEDERE
              })

            }
          }, 'json');
        });
      });
    });

  </script>




@endsection