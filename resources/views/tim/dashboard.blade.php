@extends('layouts.tim.app')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Penyusunan Kurikulum OBE</h1>
        <p class="text-gray-600 mt-2">Progress implementasi kurikulum berbasis Outcome-Based Education per Program Studi</p>
        <hr class="border-t-4 border-black my-8">
    </div>

    <!-- Filter dan Pencarian -->
    <div class="flex flex-col md:flex-row justify-between mb-6">
        <div class="flex space-x-2 mb-3 md:mb-0">
            <a href="{{ route('tim.export.excel') }}" 
                class="bg-green-600 text-white px-5 font-bold py-2 rounded-md hover:bg-green-800 inline-block mt-4">
        <i class="fas fa-file-excel mr-2"></i>Excel
        </a>
            {{-- <a href="#" 
                class="bg-blue-600 text-white px-5 font-bold py-2 rounded-md hover:bg-blue-800 inline-block mt-4">
                <i class="fas fa-file-word mr-2"></i>Word
            </a> --}}
        </div>
        <div class="relative">
            <input type="text" id="search-prodi-dashboard" placeholder="Search..." 
                class="w-full md:w-64 border border-gray-300 px-4 py-2 rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-green-500">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>

    <!-- Graphic Visualization Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Progress Per Komponen Kurikulum</h2>

        <div class="w-full" style="height: 400px;">
            <canvas id="progressChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {

    const prodis = {!! json_encode($prodis) !!};

    const labels = prodis.map(prodi => prodi.nama_prodi);
    const datasets = [
        {
            label: 'PL',
            data: prodis.map(prodi => prodi.progress_pl),
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        },
        {
            label: 'CPL',
            data: prodis.map(prodi => prodi.progress_cpl),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        {
            label: 'BK',
            data: prodis.map(prodi => prodi.progress_bk),
            backgroundColor: 'rgba(255, 206, 86, 0.6)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
        },
        {
            label: 'SKS_MK',
            data: prodis.map(prodi => prodi.progress_sks_mk),
            backgroundColor: 'rgba(153, 102, 255, 0.6)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        },
        {
            label: 'CPMK',
            data: prodis.map(prodi => prodi.progress_cpmk),
            backgroundColor: 'rgba(255, 159, 64, 0.6)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        },
        {
            label: 'SUB_CPMK',
            data: prodis.map(prodi => prodi.progress_subcpmk),
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }
    ];

    // Create chart
    const ctx = document.getElementById('progressChart').getContext('2d');
    const progressChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: false,
                    grid: {
                        display: false
                    }
                },
                y: {
                    stacked: false,
                    beginAtZero: true,
                    max: 100,
                    ticks: {
                        callback: function(value) {
                            return value + '%';
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw + '%';
                        }
                    }
                },
                legend: {
                    position: 'top',
                }
            }
        }
    });
});
</script>
@endsection