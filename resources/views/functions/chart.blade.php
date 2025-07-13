@extends('layouts.app')

@section('title', 'Chart')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Interactive Charts</h1>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Line Chart -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Sales Over Time</h2>
                <canvas id="lineChart" width="400" height="200"></canvas>
            </div>

            <!-- Bar Chart -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Revenue by Month</h2>
                <canvas id="barChart" width="400" height="200"></canvas>
            </div>

            <!-- Pie Chart -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">User Demographics</h2>
                <canvas id="pieChart" width="400" height="200"></canvas>
            </div>

            <!-- Doughnut Chart -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Device Usage</h2>
                <canvas id="doughnutChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Chart Controls -->
        <div class="mt-8 bg-gray-50 rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Chart Controls</h2>
            <div class="flex flex-wrap gap-4">
                <button onclick="updateCharts()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                    Update Data
                </button>
                <button onclick="animateCharts()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                    Animate Charts
                </button>
                <button onclick="exportChart('lineChart')" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
                    Export Line Chart
                </button>
            </div>
        </div>
    </div>

    <!-- Code Example -->
    <div class="bg-gray-100 rounded-lg p-6 mt-8">
        <h2 class="text-xl font-semibold mb-4">Chart.js Implementation:</h2>
        <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto"><code>
// Include Chart.js in your HTML head:
// &lt;script src="https://cdn.jsdelivr.net/npm/chart.js"&gt;&lt;/script&gt;

// Line Chart
const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3],
            borderColor: 'rgb(59, 130, 246)',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        }
    }
});

// Bar Chart
const barCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        datasets: [{
            label: 'Revenue',
            data: [25000, 30000, 45000, 35000],
            backgroundColor: [
                'rgba(239, 68, 68, 0.8)',
                'rgba(34, 197, 94, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(168, 85, 247, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

function updateCharts() {
    // Update line chart data
    lineChart.data.datasets[0].data = lineChart.data.datasets[0].data.map(() =>
        Math.floor(Math.random() * 50)
    );
    lineChart.update();

    // Update bar chart data
    barChart.data.datasets[0].data = barChart.data.datasets[0].data.map(() =>
        Math.floor(Math.random() * 50000)
    );
    barChart.update();
}
        </code></pre>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Line Chart
const lineCtx = document.getElementById('lineChart').getContext('2d');
const lineChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Sales',
            data: [12, 19, 3, 5, 2, 3],
            borderColor: 'rgb(59, 130, 246)',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Bar Chart
const barCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        datasets: [{
            label: 'Revenue',
            data: [25000, 30000, 45000, 35000],
            backgroundColor: [
                'rgba(239, 68, 68, 0.8)',
                'rgba(34, 197, 94, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(168, 85, 247, 0.8)'
            ],
            borderColor: [
                'rgb(239, 68, 68)',
                'rgb(34, 197, 94)',
                'rgb(59, 130, 246)',
                'rgb(168, 85, 247)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Pie Chart
const pieCtx = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['18-25', '26-35', '36-45', '46+'],
        datasets: [{
            data: [30, 40, 20, 10],
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)',
                'rgba(34, 197, 94, 0.8)',
                'rgba(239, 68, 68, 0.8)',
                'rgba(168, 85, 247, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

// Doughnut Chart
const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
const doughnutChart = new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
        labels: ['Desktop', 'Mobile', 'Tablet'],
        datasets: [{
            data: [55, 35, 10],
            backgroundColor: [
                'rgba(34, 197, 94, 0.8)',
                'rgba(59, 130, 246, 0.8)',
                'rgba(239, 68, 68, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

function updateCharts() {
    // Update line chart data
    lineChart.data.datasets[0].data = lineChart.data.datasets[0].data.map(() =>
        Math.floor(Math.random() * 50)
    );
    lineChart.update();

    // Update bar chart data
    barChart.data.datasets[0].data = barChart.data.datasets[0].data.map(() =>
        Math.floor(Math.random() * 50000)
    );
    barChart.update();

    // Update pie chart data
    pieChart.data.datasets[0].data = pieChart.data.datasets[0].data.map(() =>
        Math.floor(Math.random() * 50)
    );
    pieChart.update();

    // Update doughnut chart data
    doughnutChart.data.datasets[0].data = doughnutChart.data.datasets[0].data.map(() =>
        Math.floor(Math.random() * 70)
    );
    doughnutChart.update();
}

function animateCharts() {
    lineChart.update('active');
    barChart.update('active');
    pieChart.update('active');
    doughnutChart.update('active');
}

function exportChart(chartId) {
    const chart = document.getElementById(chartId);
    const url = chart.toDataURL();
    const link = document.createElement('a');
    link.download = chartId + '.png';
    link.href = url;
    link.click();
}
</script>
@endsection
