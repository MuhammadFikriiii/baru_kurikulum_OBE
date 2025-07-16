@extends('layouts.tim.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard Penyusunan Kurikulum OBE</h1>
            <p class="text-gray-600 mt-2">Progress implementasi kurikulum berbasis Outcome-Based Education per Program Studi
            </p>
            <hr class="border-t-4 border-black my-8">
        </div>

        <!-- Filter Tahun -->
        <div class="flex flex-col md:flex-row justify-between mb-6 gap-4">
            <!-- Export Excel -->
            <form action="{{ route('tim.export.excel') }}" method="GET" class="flex gap-2 items-center">
                <select name="id_tahun" required
                    class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled {{ empty($id_tahun) ? 'selected' : '' }}>Pilih Tahun Export</option>
                    @foreach ($availableYears as $th)
                        <option value="{{ $th->id_tahun }}" {{ $id_tahun == $th->id_tahun ? 'selected' : '' }}>
                            {{ $th->tahun }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-green-600 text-white px-5 font-bold py-2 rounded-md hover:bg-green-800">
                    <i class="fas fa-file-excel mr-2"></i>Excel
                </button>
                <button type="button" onclick="exportWord()"
                    class="bg-blue-600 px-4 py-2 rounded-lg text-white hover:bg-blue-800">
                    <i class="fas fa-file-word mr-2"></i>Word
                </button>
            </form>

            <!-- Filter Tahun Grafik -->
            <form method="GET" action="{{ route('tim.dashboard') }}" class="flex items-center">
                <label for="tahun_progress" class="mr-2 text-gray-600 text-sm">Tahun Grafik:</label>
                <select name="tahun_progress" id="tahun_progress"
                    class="border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                    required onchange="this.form.submit()">
                    <option value="" disabled selected>Pilih Tahun</option>
                    @foreach ($availableYears as $th)
                        <option value="{{ $th->id_tahun }}"
                            {{ request('tahun_progress') == $th->id_tahun ? 'selected' : '' }}>
                            {{ $th->tahun }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <!-- Grafik Progress -->
        @if (request()->filled('tahun_progress'))
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Progress Per Komponen Kurikulum</h2>
                {{-- Penjelasan minimal --}}
                <p class="text-sm text-gray-600 italic mb-4">
                    Minimal: PL 3, CPL 9, BK 8, MK 108 SKS, CPMK 18, Sub CPMK 36
                </p>
                <div class="w-full" style="height: 400px;">
                    <canvas id="progressChart"></canvas>
                </div>
            </div>
        @else
            <div class="bg-white p-8 text-center text-gray-600 rounded-lg shadow mb-8">
                <strong>Silakan pilih tahun grafik terlebih dahulu untuk menampilkan visualisasi progress.</strong>
            </div>
        @endif
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @if (request()->filled('tahun_progress'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const prodis = {!! json_encode($prodis) !!};

                const labels = prodis.map(prodi => prodi.nama_prodi);
                const datasets = [{
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
                                position: 'top'
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endsection
