@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

<div class="vh-100 w-85 text-white dashboard">

    <div class="my-5 px-5">

        {{-- titolo + select --}}
        <div class="d-flex justify-content-between mb-3">
            <h3 class="text-white mb-0">Statistiche</h3>

            <select id="yearSelect" class="form-select-sm px-2 text-light my-bg-lightdark mb-2">
                <option value="last12months" {{ $selectedYear === 'last12months' ? 'selected' : '' }}>
                    Ultimi 12 Mesi
                </option>
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
    let ordersData = @json($statistics['ordersData']);
    let earningsData = @json($statistics['earningsData']);
    let months = @json($statistics['months']); // Aggiungi i mesi dinamici

    // Funzione per creare grafico ordini
    function renderOrdersChart(data) {
        if (ordersChart) {
            ordersChart.destroy();
        }

        ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: months, // Usa i mesi dinamici qui
                datasets: [{
                    label: 'Numero di Ordini',
                    data: data,
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
                labels: months, // Usa i mesi dinamici qui
                datasets: [{
                    label: 'Guadagni €',
                    data: data,
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
            options: chartOptions
        });
    }

    // Funzione per gestire la selezione dell'anno
    function getYearData(selectedYear) {
        const url = '{{ route("admin.restaurants.statistics", $restaurant->slug) }}';

        $.ajax({
            url: url,
            method: 'GET',
            data: { year: selectedYear },
            success: function (response) {
                renderOrdersChart(response.ordersData);
                renderEarningsChart(response.earningsData);
                months = response.months; // Aggiorna dinamicamente i mesi
            },
            error: function () {
                alert('Errore nel caricamento dei dati.');
            }
        });
    }

    // Se non è stato selezionato nessun anno, usa l'anno corrente come predefinito
    let selectedYear = $('#yearSelect').val() || new Date().getFullYear(); // Anno corrente se non selezionato
    getYearData(selectedYear);

    // Cambia anno e aggiorna entrambi i grafici
    $('#yearSelect').on('change', function () {
        const selectedYear = $(this).val();
        getYearData(selectedYear);
    });
</script>


@endsection