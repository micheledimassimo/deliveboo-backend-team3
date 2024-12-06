document.addEventListener('DOMContentLoaded', () => {
    
    // Selezione degli elementi canvas
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

    // Dati iniziali (dal backend)
    let ordersData = window.statisticsData.ordersData;
    let earningsData = window.statisticsData.earningsData;
    let months = window.statisticsData.months;
    const statisticsUrl = window.statisticsData.statisticsUrl;

    // Funzione per creare grafico ordini
    function renderOrdersChart(data) {
        if (ordersChart) {
            ordersChart.destroy();
        }

        ordersChart = new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: months,
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
                labels: months,
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
        $.ajax({
            url: statisticsUrl,
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
    let selectedYear = $('#yearSelect').val() || new Date().getFullYear();
    getYearData(selectedYear);

    // Cambia anno e aggiorna entrambi i grafici
    $('#yearSelect').on('change', function () {
        const selectedYear = $(this).val();
        getYearData(selectedYear);
    });
});