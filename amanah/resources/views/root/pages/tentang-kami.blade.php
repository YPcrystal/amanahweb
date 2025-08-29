@extends('base.base-root-index')

@section('title', 'Tentang Kami | IDBC')

@section('custom-css')
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        }

        @keyframes textShine {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes glow-pulse {

            0%,
            100% {
                opacity: 0.08;
                transform: scale(0.98);
            }

            50% {
                opacity: 0.15;
                transform: scale(1.02);
            }
        }

        .animate-text-shine {
            background-size: 250% auto;
            animation: textShine 5s ease-in-out infinite;
        }

        .animate-glow-pulse {
            animation: glow-pulse 6s ease-in-out infinite alternate;
        }
    </style>
@endsection

@section('content')
    @php
        use App\Models\SiteManage;

        $header = SiteManage::where('section', 'header_tentang_kami')->where('is_active', '1')->first();
        $landasan = SiteManage::where('section', 'landasan_berfikir')->where('is_active', '1')->first();
        $muqaddimah = SiteManage::where('section', 'muqaddimah')->where('is_active', '1')->first();
        $latarBelakang = SiteManage::where('section', 'latar_belakang')->where('is_active', '1')->first();
        $visiMisi = SiteManage::where('section', 'visi_misi')->where('is_active', '1')->first();
        $keunggulan = SiteManage::where('section', 'keunggulan')->where('is_active', '1')->first();
        $sistemPendidikan = SiteManage::where('section', 'sistem_pendidikan')->where('is_active', '1')->first();
        $modelPembelajaran = SiteManage::where('section', 'model_pembelajaran')->where('is_active', '1')->first();
    @endphp

    <!-- Header Section -->
    @if ($header)
        <header class="gradient-bg text-white py-16 px-5">
            <div class="max-w-6xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $header->title }}</h1>
                <p class="text-xl max-w-3xl mx-auto">{!! $header->content !!}</p>
            </div>
        </header>
    @endif

    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100">
        <!-- Landasan berfikir -->
        @if ($landasan)
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-emerald-700 mb-6 text-center">{{ $landasan->title }}</h2>
                <div class="bg-emerald-50 text-emerald-800 p-8 rounded-xl shadow-sm">
                    <div class="text-center my-10 py-8 space-y-8">
                        @foreach ($landasan->additional_content['arabic'] as $ayat)
                            <p class="text-3xl md:text-4xl font-[Amiri] leading-[3.5rem] tracking-wide">
                                {{ $ayat }}
                            </p>
                        @endforeach
                    </div>
                    <div class="text-center mb-6 px-4">
                        <p class="text-lg md:text-xl leading-relaxed text-emerald-900">
                            @if (is_array($landasan->additional_content['translation']))
                                @foreach ($landasan->additional_content['translation'] as $translation)
                                    <p>{{ $translation }}</p>
                                @endforeach
                            @else
                                {{ $landasan->additional_content['translation'] }}
                            @endif
                        </p>
                    </div>
                    <p class="text-center md:text-lg leading-relaxed text-emerald-700 mt-4">
                        @if (is_array($landasan->additional_content['reference']))
                            @foreach ($landasan->additional_content['reference'] as $reference)
                                <p>{{ $reference }}</p>
                            @endforeach
                        @else
                            {{ $landasan->additional_content['reference'] }}
                        @endif
                    </p>
                </div>
            </div>
        @endif

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Muqaddimah Section -->
        @if ($muqaddimah)
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">{{ $muqaddimah->title }}</h2>
                <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                    @if (is_array($muqaddimah->additional_content['paragraphs']))
                        @foreach ($muqaddimah->additional_content['paragraphs'] as $paragraph)
                            <p class="mb-4">{{ $paragraph }}</p>
                        @endforeach
                    @else
                        {{ $muqaddimah->additional_content['paragraphs'] }}
                    @endif
                </div>
            </div>
        @endif

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Latar Belakang Section -->
        @if ($latarBelakang)
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">{{ $latarBelakang->title }}</h2>
                <p class="text-xl text-gray-700 mb-6 text-center">{{ $latarBelakang->content }}</p>
                <ul class="grid md:grid-cols-2 gap-6 list-none p-0">
                    @foreach ($latarBelakang->additional_content['points'] as $index => $point)
                        <li class="bg-teal-50 p-6 rounded-xl shadow-sm flex items-start space-x-3 border border-teal-100">
                            <span class="text-teal-600 text-2xl font-bold flex-shrink-0">{{ $index + 1 }}.</span>
                            <p class="text-gray-700 text-lg">{{ $point }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Visi & Misi Section -->
        @if ($visiMisi)
            <div class="grid md:grid-cols-2 gap-10 mb-12">
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <h2 class="text-3xl font-bold text-emerald-700 mb-4">Visi</h2>
                    <p class="text-gray-800 text-xl leading-relaxed">
                        {{ $visiMisi->additional_content['visi'] }}
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                    <h2 class="text-3xl font-bold text-emerald-700 mb-4">Misi</h2>
                    <ul class="list-none p-0 space-y-3 text-gray-800 text-lg">
                        @foreach ($visiMisi->additional_content['misi'] as $misi)
                            <li class="flex items-start">
                                <svg class="w-6 h-6 text-emerald-600 mr-2 mt-1 flex-shrink-0" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                {{ $misi }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Keunggulan Section -->
        @if ($keunggulan)
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">{{ $keunggulan->title }}</h2>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($keunggulan->additional_content['points'] as $point)
                        <div class="bg-teal-50 p-6 rounded-xl shadow-sm border border-teal-100 flex items-center space-x-4">
                            <svg class="w-8 h-8 text-teal-600 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-gray-700 text-lg font-medium">{{ $point }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Sistem Pendidikan -->
        @if ($sistemPendidikan)
            <div>
                <h2 class="text-3xl font-bold text-teal-800 mb-6 text-center">{{ $sistemPendidikan->title }}</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    @foreach ($sistemPendidikan->additional_content['points'] as $system)
                        <div
                            class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100 {{ $system['name'] === 'Balancing' ? 'md:col-span-2' : '' }}">
                            <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                                {!! $system['icon'] !!}
                                {{ $system['name'] }}
                            </h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                {{ $system['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <hr class="my-12 border-t-2 border-teal-100">

        <!-- Model Pembelajaran -->
        @if ($modelPembelajaran)
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-teal-800 mb-10 text-center">{{ $modelPembelajaran->title }}</h2>

                <!-- Diagram Container (Full Width) -->
                <div class="flex justify-center mb-10">
                    <div class="bg-gradient-to-r from-emerald-400 to-teal-500 p-2 rounded-xl shadow-lg">
                        <img src="{{ asset($modelPembelajaran->image_path) }}" alt="{{ $modelPembelajaran->title }}"
                            class="max-h-96 w-auto object-contain rounded-lg bg-white p-6 shadow-inner">
                    </div>
                </div>

                <!-- Text Descriptions (Side by Side) -->
                <div class="grid md:grid-cols-2 gap-8">
                    @foreach ($modelPembelajaran->additional_content['points'] as $system)
                        <!-- Description 1 -->
                        <div class="bg-emerald-50 p-8 rounded-2xl shadow-md border border-emerald-100">
                            <div class="flex items-start">
                                <div class="bg-emerald-100 text-emerald-600 p-3 rounded-lg mr-4">
                                    {!! $system['icon'] !!}
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-emerald-700 mb-3 flex items-center">
                                        {{ $system['name'] }}</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $system['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
