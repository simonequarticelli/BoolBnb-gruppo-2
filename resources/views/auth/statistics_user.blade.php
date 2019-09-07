@extends('layouts.app')

@section('content')
  @include('layouts.nav')

  <div class="container w-25 mt-3">
    <canvas id="myChart" width="400" height="400"></canvas>
  </div>

  @php
      $houses_user = Auth::user()->houses;
      $array_houses = $houses_user->all();
      //dd($array_houses);
  @endphp
  

  {{-- CHART.JS --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>

  <script>


    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
            labels: ['Messaggi', 'Visualizzazioni'],
            datasets: [{
                label: 'STATISTICHE',
                data: ['{{ $count_messages }}', '{{ $count_view }}'],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
  </script>

@endsection
