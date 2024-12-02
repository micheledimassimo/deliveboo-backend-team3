@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

<div class="vh-100 w-85 text-white dashboard">

    <div class="my-5 px-5">

        <h3 class="text-white">
            Statistiche
        </h3>

        {{-- grafico ordini --}}
        <div class="row">
            
            <div class="col-lg-8">
                <div class="card text-white my-bg-dark mb-3">
                    <div class="card-body">

                        {{-- anno --}}
                        <div class="d-flex justify-content-between">
                            <div>
                                <label for="yearSelectOrders" class="form-label me-2">Ordini</label>
                            </div>
                            <div>
                                <select id="yearSelectOrders" class="form-select-sm px-2 text-light my-bg-lightdark">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            Anno {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- grafico --}}
                        <div class="chart-container">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- card totale --}}
            <div class="col-lg-4">
                <div class="card text-white my-bg-dark mb-4">
                    <div class="card-body text-center">
                        <h6>Numero di Ordini Totali</h6>
                        <h3 id="totalOrders">{{ $totalOrders }}</h3>
                    </div>
                </div>
            </div>

        </div>

        {{-- grafico guadagni --}}
        <div class="row">

                <div class="col-lg-8">
                    <div class="card text-white my-bg-dark">
                        <div class="card-body">
        
                            {{-- anno --}}
                            <div class="d-flex justify-content-between">
                                <div>
                                    <label for="yearSelectEarnings" class="form-label me-2">Guadagni</label>
                                </div>
                                <div>
                                    <select id="yearSelectEarnings" class="form-select-sm px-2 text-light my-bg-lightdark">
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                                Anno {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            {{-- grafico --}}
                            <div class="chart-container">
                                <canvas id="earningsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- card totale --}}
                <div class="col-lg-4">
                    <div class="card text-white my-bg-dark">
                        <div class="card-body text-center">
                            <h6>Guadagno Totale</h6>
                            <h3 id="totalEarnings">{{ number_format($totalEarnings, 2) }} €</h3>
                        </div>
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
    let totalOrders = @json($totalOrders);
    let totalEarnings = @json($totalEarnings);

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

    // Funzione per aggiornare le card
    function updateCards(orders, earnings) {
        $('#totalOrders').text(orders);
        $('#totalEarnings').text(earnings.toFixed(2));
    }

    // Inizializza grafici
    renderOrdersChart(ordersData);
    renderEarningsChart(earningsData);

    // Cambia anno per ordini
    $('#yearSelectOrders').on('change', function () {
        const selectedYear = $(this).val();
        const url = '{{ route("admin.restaurants.statistics", $restaurant->slug) }}';

        $.ajax({
            url: url,
            method: 'GET',
            data: { year: selectedYear },
            success: function (response) {
                // Aggiorna grafico ordini e card ordini
                renderOrdersChart(response.ordersData);
                $('#totalOrders').text(response.totalOrders); // Aggiorna solo la card degli ordini
            },
            error: function () {
                alert('Errore nel caricamento dei dati per gli ordini.');
            }
        });
    });

    // Cambia anno per guadagni
    $('#yearSelectEarnings').on('change', function () {
        const selectedYear = $(this).val();
        const url = '{{ route("admin.restaurants.statistics", $restaurant->slug) }}';

        $.ajax({
            url: url,
            method: 'GET',
            data: { year: selectedYear },
            success: function (response) {
                // Aggiorna grafico guadagni e card guadagni
                renderEarningsChart(response.earningsData);
                $('#totalEarnings').text(response.totalEarnings.toFixed(2) + ' €'); // Aggiorna solo la card dei guadagni
            },
            error: function () {
                alert('Errore nel caricamento dei dati per i guadagni.');
            }
        });
    });
</script>

<style>
    .chart-container {
        height: 30vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    canvas {
        display: block;
        width: 100%;
        height: 100%;
    }
</style>

@endsection