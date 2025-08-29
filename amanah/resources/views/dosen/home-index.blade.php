@extends('base.base-dash-index')
@section('title')
    Dashboard Dosen - SIAKAD PT
@endsection
@section('menu')
    Beranda
@endsection
@section('submenu')
    Dashboard Dosen
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Ringkasan aktivitas mengajar dan informasi terkini
@endsection
@push('styles')
    <style>
        .dashboard-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-left: 4px solid;
            position: relative;
            overflow: hidden;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover::before {
            opacity: 1;
        }

        .card-jadwal {
            border-left-color: #0C6E71;
            background: linear-gradient(135deg, #ffffff 0%, #f8fffe 100%);
        }

        .card-jadwal:hover {
            border-left-color: #FF6B35;
        }

        .card-feedback {
            border-left-color: #4E9F3D;
            background: linear-gradient(135deg, #ffffff 0%, #f8fff8 100%);
        }

        .card-feedback:hover {
            border-left-color: #FF6B35;
        }

        .card-icon {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transition: all 0.3s ease;
            transform: translate(-50%, -50%);
        }

        .group:hover .card-icon::before {
            width: 100%;
            height: 100%;
        }

        .welcome-banner {
            background: linear-gradient(135deg, #0C6E71 0%, #4E9F3D 100%);
            position: relative;
            overflow: hidden;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }

        .avatar-gradient {
            background: linear-gradient(135deg, #0C6E71 0%, #FF6B35 100%);
            position: relative;
        }

        .avatar-gradient::before {
            content: '';
            position: absolute;
            inset: 2px;
            background: #0C6E71;
            border-radius: inherit;
        }

        .avatar-gradient span {
            position: relative;
            z-index: 1;
        }

        .schedule-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
        }

        .schedule-card:hover {
            border-color: #0C6E71;
            background: linear-gradient(135deg, #f8fffe 0%, #ffffff 100%);
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(12, 110, 113, 0.15);
        }

        .status-badge {
            position: relative;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .satisfaction-chart-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 16px;
            position: relative;
            overflow: hidden;
        }

        .satisfaction-chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent 0%, rgba(12, 110, 113, 0.05) 50%, transparent 100%);
        }

        .section-header {
            background: linear-gradient(135deg, #0C6E71 0%, #4E9F3D 100%);
            position: relative;
            overflow: hidden;
        }

        .section-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        .modal-content {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
            pointer-events: auto;
            position: relative;
            z-index: 10;
        }

        .modal-overlay {
            backdrop-filter: blur(8px);
            background: rgba(0, 0, 0, 0.5);
            pointer-events: auto;
            position: fixed;
            z-index: 5;
        }

        @media (max-width: 768px) {
            .card-content {
                flex-direction: column;
                text-align: center;
            }

            .card-icon {
                margin-bottom: 1rem;
            }

            .chart-container {
                width: 100% !important;
            }

            .dashboard-card:hover {
                transform: translateY(-4px);
            }
        }

        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-ring {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(34, 197, 94, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        .gradient-text {
            background: linear-gradient(135deg, #0C6E71 0%, #4E9F3D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }

        /* Enhanced loading states */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }
    </style>
@endpush
@section('content')
    <section class="container mx-auto p-2 md:p-4">
        <!-- Welcome Banner -->
        <div class="welcome-banner rounded-2xl shadow-lg overflow-hidden mb-8 relative">
            <div class="p-8 flex flex-col md:flex-row items-center relative z-10">
                <div class="text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-md">
                        Selamat Datang, {{ Auth::guard('dosen')->user()->name }}
                    </h1>
                    <p class="text-white/90 text-lg">
                        @php
                            $hour = date('G');
                            if ($hour >= 5 && $hour < 11) {
                                echo 'Selamat pagi';
                            } elseif ($hour >= 11 && $hour < 15) {
                                echo 'Selamat siang';
                            } elseif ($hour >= 15 && $hour < 18) {
                                echo 'Selamat sore';
                            } else {
                                echo 'Selamat malam';
                            }
                        @endphp
                        , semoga hari Anda menyenangkan dan produktif!
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Cards and Chart -->
            <div class="w-full lg:w-3/4 space-y-8">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Jadwal Mengajar Card -->
                    <a href="{{ route('dosen.akademik.jadwal-index') }}" class="group">
                        <div class="dashboard-card card-jadwal rounded-2xl shadow-md overflow-hidden h-full">
                            <div class="p-6 flex items-center card-content">
                                <div
                                    class="card-icon w-16 h-16 flex items-center justify-center rounded-2xl bg-[#0C6E71] text-white group-hover:bg-[#FF6B35] shadow-lg">
                                    <i class="fa-solid fa-calendar-days text-2xl"></i>
                                </div>
                                <div class="ml-6 flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">Jadwal Mengajar</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 text-sm font-medium">Total kelas yang diajar</p>
                                        <span class="text-3xl font-bold gradient-text">
                                            {{ \App\Models\JadwalKuliah::where('dosen_id', Auth::guard('dosen')->user()->id)->count() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <!-- Feedback Card -->
                    <a href="{{ route('dosen.akademik.jadwal-index') }}" class="group">
                        <div class="dashboard-card card-feedback rounded-2xl shadow-md overflow-hidden h-full">
                            <div class="p-6 flex items-center card-content">
                                <div
                                    class="card-icon w-16 h-16 flex items-center justify-center rounded-2xl bg-[#4E9F3D] text-white group-hover:bg-[#FF6B35] shadow-lg">
                                    <i class="fa-solid fa-star text-2xl"></i>
                                </div>
                                <div class="ml-6 flex-1">
                                    <h3 class="text-xl font-bold text-gray-800 mb-1">Feedback Mahasiswa</h3>
                                    <div class="flex items-center justify-between">
                                        <p class="text-gray-600 text-sm font-medium">Total feedback diterima</p>
                                        <span class="text-3xl font-bold gradient-text">{{ $feedback->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Today's Schedule -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="section-header px-6 py-4 flex items-center justify-between">
                        <h3 class="text-white font-bold text-lg">
                            <i class="fas fa-calendar-day mr-3"></i> Jadwal Hari Ini
                        </h3>
                        <span class="text-white bg-[#FF6B35] px-4 py-2 rounded-full text-sm font-semibold shadow-md">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                    <div class="p-6">
                        @php
                            $todayIndex = \Carbon\Carbon::now()->dayOfWeek; // 0=Sunday, 1=Monday, etc.
                            $todaySchedules = \App\Models\JadwalKuliah::where(
                                'dosen_id',
                                Auth::guard('dosen')->user()->id,
                            )
                                ->where('days_id', $todayIndex)
                                ->with('matkul', 'kelas')
                                ->orderBy('start')
                                ->get();
                        @endphp

                        @if ($todaySchedules->count() > 0)
                            <div class="space-y-4">
                                @foreach ($todaySchedules as $schedule)
                                    <div class="schedule-card rounded-xl p-5">
                                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                                            <div class="flex-1">
                                                <h4 class="font-bold text-gray-800 text-lg mb-2">
                                                    {{ $schedule->matkul->name ?? '-' }}</h4>
                                                <div class="space-y-1 text-gray-600">
                                                    <p class="flex items-center text-sm">
                                                        <i class="fas fa-users w-4 mr-2"></i>
                                                        <span class="font-medium">Kelas:</span>
                                                        {{ $schedule->kelas->name ?? '-' }}
                                                    </p>
                                                    <p class="flex items-center text-sm">
                                                        <i class="fas fa-door-open w-4 mr-2"></i>
                                                        <span class="font-medium">Ruang:</span>
                                                        {{ $schedule->ruang->name ?? '-' }}
                                                    </p>
                                                    <p class="flex items-center text-sm">
                                                        <i class="fas fa-clock w-4 mr-2"></i>
                                                        <span class="font-medium">Waktu:</span>
                                                        {{ \Carbon\Carbon::parse($schedule->start)->format('H:i') }} -
                                                        {{ \Carbon\Carbon::parse($schedule->ended)->format('H:i') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-4 md:mt-0 md:ml-6">
                                                <span
                                                    class="status-badge inline-block px-4 py-2 rounded-full text-sm font-semibold shadow-sm
                                                        @if (\Carbon\Carbon::parse($schedule->ended)->lt(now())) bg-gray-100 text-gray-700
                                                        @elseif(\Carbon\Carbon::parse($schedule->start)->lte(now()) && \Carbon\Carbon::parse($schedule->ended)->gt(now()))
                                                            bg-green-100 text-green-800 pulse-ring
                                                        @else
                                                            bg-blue-100 text-blue-800 @endif">
                                                    @if (\Carbon\Carbon::parse($schedule->ended)->lt(now()))
                                                        <i class="fas fa-check-circle mr-1"></i> Selesai
                                                    @elseif(\Carbon\Carbon::parse($schedule->start)->lte(now()) && \Carbon\Carbon::parse($schedule->ended)->gt(now()))
                                                        <i class="fas fa-play-circle mr-1"></i> Berlangsung
                                                    @else
                                                        <i class="fas fa-clock mr-1"></i> Akan Datang
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div
                                    class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-calendar-check text-4xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-500 text-lg font-medium">Tidak ada jadwal mengajar hari ini</p>
                                <p class="text-gray-400 text-sm mt-2">Nikmati waktu luang Anda!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Satisfaction Chart -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="section-header px-6 py-4">
                        <h3 class="text-white font-bold text-lg">
                            <i class="fas fa-chart-pie mr-3"></i> Statistik Kepuasan Mengajar
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="satisfaction-chart-container p-6 relative">
                            <div id="grafikChart" class="h-80 relative z-10"></div>
                        </div>
                        <div class="mt-4 p-4 bg-gray-50 rounded-xl">
                            <p class="text-center text-sm text-gray-600 font-medium">
                                <i class="fas fa-info-circle mr-2"></i>
                                Data berdasarkan feedback mahasiswa dari seluruh kelas yang Anda ajar
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Announcements -->
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-6">
                    <!-- Pengumuman Section -->
                    <div class="w-full">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="bg-teal-700 px-4 py-3">
                                <h3 class="text-white font-semibold">Pengumuman -
                                    {{ \Carbon\Carbon::now()->format('d M Y') }}
                                </h3>
                            </div>
                            <div class="p-4">
                                @forelse ($notify as $item)
                                    <div class="mb-3 pb-3 border-b border-gray-100 last:border-0 last:mb-0 last:pb-0">
                                        <p class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y - H.i') }}
                                        </p>
                                        <button onclick="openModal('{{ $item->code }}')"
                                            class="text-teal-700 hover:text-orange-600 font-medium mt-1 transition-colors duration-200">
                                            {{ $item->name }}
                                        </button>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-center py-4">Tidak ada pengumuman hari ini</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var ajaxRunning = false;

        $(document).ready(function() {
            // Enhanced AJAX function with better error handling
            function fetchData() {
                if (ajaxRunning) return;
                ajaxRunning = true;

                // Show loading state
                $('#grafikChart').html(
                    '<div class="flex items-center justify-center h-full"><div class="loading-shimmer w-32 h-32 rounded-full"></div></div>'
                );

                $.ajax({
                    url: '{{ route('dosen.services.ajax.graphic.kepuasan-mengajar-dosen') }}',
                    method: 'GET',
                    timeout: 10000,
                    success: function(response) {
                        var options = {
                            chart: {
                                type: 'donut',
                                height: '100%',
                                fontFamily: 'Inter, system-ui, sans-serif',
                                animations: {
                                    enabled: true,
                                    easing: 'easeinout',
                                    speed: 1200,
                                    animateGradually: {
                                        enabled: true,
                                        delay: 200
                                    },
                                    dynamicAnimation: {
                                        enabled: true,
                                        speed: 400
                                    }
                                },
                                dropShadow: {
                                    enabled: true,
                                    top: 3,
                                    left: 3,
                                    blur: 5,
                                    opacity: 0.1
                                }
                            },
                            series: [response.tidakpuas, response.cukuppuas, response.sangatpuas],
                            labels: ['Tidak Puas', 'Cukup Puas', 'Sangat Puas'],
                            colors: ['#EF4444', '#F59E0B', '#10B981'],
                            legend: {
                                position: 'bottom',
                                horizontalAlign: 'center',
                                fontSize: '14px',
                                fontWeight: 600,
                                labels: {
                                    colors: '#374151'
                                },
                                markers: {
                                    width: 12,
                                    height: 12,
                                    radius: 6
                                },
                                itemMargin: {
                                    horizontal: 15,
                                    vertical: 8
                                }
                            },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '70%',
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                showAlways: true,
                                                label: 'Total Feedback',
                                                fontSize: '16px',
                                                fontWeight: 'bold',
                                                color: '#1F2937',
                                                formatter: function(w) {
                                                    return w.globals.seriesTotals.reduce((a,
                                                        b) => {
                                                        return a + b
                                                    }, 0)
                                                }
                                            },
                                            value: {
                                                fontSize: '24px',
                                                fontWeight: 'bold',
                                                color: '#0C6E71',
                                                formatter: function(value) {
                                                    return value
                                                }
                                            }
                                        }
                                    },
                                    expandOnClick: true
                                }
                            },
                            states: {
                                hover: {
                                    filter: {
                                        type: 'lighten',
                                        value: 0.1
                                    }
                                },
                                active: {
                                    allowMultipleDataPointsSelection: false,
                                    filter: {
                                        type: 'darken',
                                        value: 0.1
                                    }
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 280
                                    },
                                    legend: {
                                        position: 'bottom',
                                        fontSize: '12px'
                                    }
                                }
                            }],
                            tooltip: {
                                enabled: true,
                                theme: 'light',
                                style: {
                                    fontSize: '14px',
                                    fontFamily: 'Inter, system-ui, sans-serif'
                                },
                                y: {
                                    formatter: function(value, opts) {
                                        if (!opts || !opts.w) return value;
                                        const w = opts.w;
                                        const total = w.globals.seriesTotals.reduce((a, b) =>
                                            a + b, 0);
                                        const percentage = ((value / total) * 100).toFixed(1);
                                        return value + " feedback (" + percentage + "%)";
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                formatter: function(val, opts) {
                                    return Math.round(val) + "%";
                                },
                                style: {
                                    fontSize: '12px',
                                    fontWeight: 'bold',
                                    colors: ['#fff']
                                },
                                dropShadow: {
                                    enabled: true,
                                    top: 1,
                                    left: 1,
                                    blur: 1,
                                    opacity: 0.8
                                }
                            },
                            stroke: {
                                width: 2,
                                colors: ['#fff']
                            }
                        };

                        // Clear loading state
                        $('#grafikChart').empty();

                        var chart = new ApexCharts(document.querySelector('#grafikChart'), options);
                        chart.render();

                        // Add success animation
                        setTimeout(() => {
                            $('#grafikChart').addClass('animate-fadeIn');
                        }, 500);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading chart:', error);
                        $('#grafikChart').html(`
                            <div class="flex flex-col items-center justify-center h-full text-gray-500">
                                <i class="fas fa-exclamation-triangle text-4xl mb-4 text-yellow-500"></i>
                                <p class="text-lg font-medium mb-2">Gagal memuat data</p>
                                <p class="text-sm">Silakan refresh halaman</p>
                                <button onclick="location.reload()" class="mt-4 px-4 py-2 bg-[#0C6E71] text-white rounded-lg hover:bg-[#0a5c5e] transition-colors">
                                    <i class="fas fa-refresh mr-2"></i>Refresh
                                </button>
                            </div>
                        `);
                    },
                    complete: function() {
                        ajaxRunning = false;
                    }
                });
            }

            // Initialize chart with delay for better UX
            setTimeout(fetchData, 300);
        });
    </script>
@endpush
