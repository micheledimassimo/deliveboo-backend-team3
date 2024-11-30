@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

    <div class="vh-100 w-85 my-bg-black text-white p-5">

            <div class="card text-white my-bg-dark">

                <div class="card-body">
                    <h5>Statistiche degli ordini</h5>

                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>

            </div>

    </div>
      
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
    <script>
        const ctx = document.getElementById('myChart');

        // Passa i dati dal backend
        const ordersData = @json($data);
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
                'Gennaio',
                'Febbraio',
                'Marzo',
                'Aprile',
                'Maggio',
                'Giugno',
                'Luglio',
                'Agosto',
                'Settembre',
                'Ottobre',
                'Novmbre',
                'Dicembre',
            ],

            datasets: [{
              label: 'Numbero di ordini',
              data: ordersData, // Usa i dati passati dal backend

            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
            ],
            borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
            ],
              borderWidth: 1
            }]
          },

          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
    </script>

@endsection