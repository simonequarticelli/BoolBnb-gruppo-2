@extends('layouts.app')

@include('layouts.nav')
@section('content')

  <section class="message_box_container">
   <div class="container">
      <table class="table">
          <thead>
            <tr>
              <th><i class="fas fa-trash"></i></th>
              <th></th>

            </tr>
          </thead>

          <tbody>
            {{-- primo mess --}}
              <tr>
                  <td><input type="checkbox" name="" value=""></td>
                  <td class="info-message clickable" data-toggle="collapse" data-target="#accordion" aria-expanded="false" aria-controls="collapseExample" >
                    <div  class="col-lg-10">
                      <h5>Ferdinando</h5>
                      <p>Oggetto del messaggio</p>
                    </div>
                    <div class="hour-received">
                        <small>19:00</small>
                    </div>
                  </td>
              </tr>
              <tr>
                  <td class="message-box" colspan="3">
                      <div id="accordion" class="collapse">
                        <p class="card card-body">Hidden by default</p>
                      </div>
                  </td>
              </tr>
            {{-- secondo mess --}}
              <tr>
                  <td><input type="checkbox" name="" value=""></td>
                  <td class="info-message  clickable" data-toggle="collapse" data-target="#accordion2" aria-expanded="false" aria-controls="collapseExample" >
                    <div  class="col-lg-10">
                      <h5>Ferdinando</h5>
                      <p>Oggetto del messaggio</p>
                    </div>
                    <div class="hour-received">
                        <small>19:00</small>
                    </div>
                  </td>
              </tr>
              <tr>
                  <td class="message-box" colspan="3">
                      <div id="accordion2" class="collapse">
                        <p class="card  card-body">Hidden by default</p>
                      </div>
                  </td>
              </tr>
          </tbody>
          </table>
    </div>
  </section>


@endsection
