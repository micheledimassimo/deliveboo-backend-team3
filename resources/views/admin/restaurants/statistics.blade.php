@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

<div class="vh-100 w-85 text-white dashboard">

    <div class="my-5 px-5">

        {{-- titolo + select --}}
        <div class="d-flex justify-content-between mb-3">
            <h3 class="text-white mb-0">Statistiche</h3>

            <select id="yearSelect" class="form-select-sm px-2 text-light my-bg-lightdark mb-2">
                @foreach ($years as $year)
                    <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                        Anno {{ $year }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Grafico ordini --}}
        <div class="card text-white my-bg-dark mb-3">
            <div class="card-body">
                <h6>Numero di Ordini</h6>
                <div class="chart-container">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Grafico guadagni --}}
        <div class="card text-white my-bg-dark">
            <div class="card-body">
                <h6>Guadagni</h6>
                <div class="chart-container">
                    <canvas id="earningsChart"></canvas>
                </div>
            </div>
        </div>
    
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const ordersCtx = document.getElementById('ordersChart');
    const earningsCtx = document.getElementById('earningsChart');
    let ordersChart, earningsChart;

    // Opzioni globali per i grafici
    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Dati iniziali
    let ordersData = @json($ordersData);
    let earningsData = @json($earningsData);

    // Funzione per creare grafico ordini
    function renderOrdersChart(data) {
        if (ordersChart) {
            ordersChart.destroy();
        }

        ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: [
                    'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
                    'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre',
                ],
                datasets: [{
                    label: 'Numero di Ordini',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgb(54, 162, 235)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });
    }

    // Funzione per creare grafico guadagni
    function renderEarningsChart(data) {
        if (earningsChart) {
            earningsChart.destroy();
        }

        earningsChart = new Chart(earningsCtx, {
            type: 'line',
            data: {
                labels: [
                    'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
                    'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre',
                ],
                datasets: [{
                    label: 'Guadagni €',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 1
                }]
            },
            options: chartOptions
        });
    }

    // Inizializza i grafici
    renderOrdersChart(ordersData);
    renderEarningsChart(earningsData);

    // Cambia anno e aggiorna entrambi i grafici
    $('#yearSelect').on('change', function () {
        const selectedYear = $(this).val();
        const url = '{{ route("admin.restaurants.statistics", $restaurant->slug) }}';

        $.ajax({
            url: url,
            method: 'GET',
            data: { year: selectedYear },
            success: function (response) {
                renderOrdersChart(response.ordersData);
                renderEarningsChart(response.earningsData);
            },
            error: function () {
                alert('Errore nel caricamento dei dati.');
            }
        });
    });
</script>

@endsection