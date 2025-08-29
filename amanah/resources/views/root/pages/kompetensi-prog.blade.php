@extends('base.base-root-index')

@section('title', 'Kompetensi Programmer | IDBC')

@section('custom-css')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0fdfa 0%, #ffffff 100%);
        }

        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 2.5rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 70%;
            height: 4px;
            background: linear-gradient(90deg, #0d9488, #059669);
            border-radius: 2px;
        }

        .programmer-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
            background: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .programmer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .programmer-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .highlight-text {
            position: relative;
            padding: 0 5px;
            z-index: 1;
        }

        .highlight-text:after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 40%;
            background-color: rgba(13, 148, 136, 0.2);
            z-index: -1;
            border-radius: 3px;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
        }

        .feature-badge {
            position: absolute;
            top: -12px;
            right: -12px;
            background: linear-gradient(135deg, #0d9488, #059669);
            color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .tech-item {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .tech-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .tech-icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
            background: #f0fdfa;
            color: #059669;
        }

        .tech-content {
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .tech-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .tech-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }

        /* Additional styles for programmer section */
        .programmer-header {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
            padding: 5rem 1rem;
        }

        .programmer-feature {
            transition: all 0.3s ease;
            border-radius: 12px;
        }

        .programmer-feature:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .materi-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            margin-bottom: 1rem;
            background: white;
            border-radius: 12px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .materi-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .materi-number {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #0d9488, #059669);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 1.5rem;
            flex-shrink: 0;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #0d9488 0%, #059669 100%);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(13, 148, 136, 0.3);
        }

        .btn-outline {
            border: 2px solid #0d9488;
            color: #0d9488;
            transition: all 0.3s ease;
        }

        .btn-outline:hover {
            background: #f0fdfa;
        }

        /* Icon colors */
        .feature-icon {
            background: #f0fdfa;
            color: #059669;
        }

        .benefit-icon {
            background: #f0fdfa;
            color: #059669;
        }
    </style>
@endsection

@section('content')
    @php
        use App\Models\SiteManage;

        $header = SiteManage::where('section', 'header_kompetensi_programmer')->where('is_active', '1')->first();
        $overview = SiteManage::where('section', 'overview_programmer')->where('is_active', '1')->first();
        $benefits = SiteManage::where('section', 'benefits_programmer')->where('is_active', '1')->first();
        $features = SiteManage::where('section', 'features')->where('is_active', '1')->first();
        $cta = SiteManage::where('section', 'call_to_action_programmer')->where('is_active', '1')->first();
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

    <!-- Main Content Section -->
    <section class="py-16 px-5 bg-gradient-to-r from-teal-50 to-emerald-50">
        <div class="max-w-6xl mx-auto">
            <!-- Main Card -->
            <div class="programmer-card overflow-hidden">
                <!-- Header with Icon -->
                @if ($overview)
                    <div class="gradient-bg p-6 flex items-center">
                        <div class="bg-white/20 p-4 rounded-full mr-4">
                            <i class="fas fa-code text-white text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">{{ $overview->title }}</h3>
                            <p class="text-teal-100">{{ $overview->content }}</p>
                        </div>
                    </div>
                @endif

                <!-- Content Section -->
                <div class="p-8">
                    @if ($overview)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Left Column -->
                            <div>
                                <div class="mb-8">
                                    <h4 class="text-xl font-bold text-teal-800 mb-4">
                                        {{ $overview->additional_content['left']['title'] }}</h4>
                                    <p class="text-gray-700 mb-4">
                                        {{ $overview->additional_content['left']['description'] }}
                                    </p>
                                    <div class="bg-teal-50 border-l-4 border-teal-500 p-4 rounded-r-lg">
                                        <p class="text-gray-800 italic">
                                            "{{ $overview->additional_content['left']['quote'] }}"
                                        </p>
                                    </div>
                                </div>

                                <!-- Learning Method -->
                                <div class="bg-gray-50 rounded-lg p-6 border border-gray-200 programmer-feature">
                                    <div class="flex items-start mb-4">
                                        <div class="feature-icon p-3 rounded-lg mr-4">
                                            {!! $overview->additional_content['left']['learning_method']['icon'] !!}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-teal-800 text-lg mb-2">
                                                {{ $overview->additional_content['left']['learning_method']['title'] }}</h4>
                                            <p class="text-gray-700">
                                                {{ $overview->additional_content['left']['learning_method']['description'] }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div>
                                <h4 class="text-xl font-bold text-teal-800 mb-4">
                                    {{ $overview->additional_content['right']['title'] }}</h4>

                                <div class="space-y-4">
                                    @foreach ($overview->additional_content['right'] as $key => $tech)
                                        @if (is_array($tech) && isset($tech['no']))
                                            <div class="materi-item">
                                                <div class="materi-number">{{ $tech['no'] }}</div>
                                                <div>
                                                    <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $tech['title'] }}
                                                    </h3>
                                                    <p class="text-gray-600">{{ $tech['description'] }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Benefit Highlights -->
                    @if ($benefits)
                        <div class="mt-10">
                            <h4 class="text-xl font-bold text-teal-800 mb-6 text-center">{{ $benefits->title }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach ($benefits->additional_content['points'] as $point)
                                    <div
                                        class="programmer-feature bg-white border border-gray-200 rounded-xl p-6 text-center">
                                        <div
                                            class="benefit-icon w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                            {!! $point['icon'] !!}
                                        </div>
                                        <h5 class="font-bold text-gray-800 mb-2">{{ $point['name'] }}</h5>
                                        <p class="text-gray-600 text-sm">{{ $point['description'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Additional Features -->
                    @if ($features)
                        <div class="mt-12">
                            <h4 class="text-xl font-bold text-teal-800 mb-6 text-center">{{ $features->title }}</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach ($features->additional_content['points'] as $point)
                                    <div class="tech-item">
                                        <div class="tech-icon">
                                            {!! $point['icon'] !!}
                                        </div>
                                        <div class="tech-content">
                                            <h5 class="font-bold text-gray-800 mb-2">{{ $point['name'] }}</h5>
                                            <p class="text-gray-600">{{ $point['description'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- CTA Section -->
                    @if ($cta)
                        <div class="mt-12 text-center bg-gray-50 rounded-xl p-8">
                            <h4 class="text-2xl font-bold text-teal-800 mb-4">{{ $cta->title }}</h4>
                            <p class="text-gray-700 mb-6 max-w-2xl mx-auto">
                                {{ $cta->content }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
