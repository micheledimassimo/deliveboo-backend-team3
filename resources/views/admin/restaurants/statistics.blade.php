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
        window.statisticsData = {
            ordersData: @json($statistics['ordersData']),
            earningsData: @json($statistics['earningsData']),
            months: @json($statistics['months']),
            statisticsUrl: '{{ route("admin.restaurants.statistics", $restaurant->slug) }}',
        };
    </script>

    @push('scripts')
        @vite('resources/js/statistics.js')
    @endpush

@endsection