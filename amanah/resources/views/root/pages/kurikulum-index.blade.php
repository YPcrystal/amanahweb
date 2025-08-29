@extends('base.base-root-index')

@section('title', 'Kurikulum | IDBC')

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

        .curriculum-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 16px;
            overflow: hidden;
        }

        .curriculum-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .curriculum-icon {
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

        .goal-item {
            display: flex;
            align-items: flex-start;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }

        .goal-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .goal-icon {
            flex-shrink: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            font-size: 1.5rem;
        }

        .goal-content {
            flex-grow: 1;
        }

        @media (max-width: 768px) {
            .goal-item {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .goal-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
@endsection

@section('content')
    @php
        use App\Models\SiteManage;

        $header = SiteManage::where('section', 'header_kurikulum')->where('is_active', '1')->first();
        $overview = SiteManage::where('section', 'overview_kurikulum')->where('is_active', '1')->first();
        $curriculumStructure = SiteManage::where('section', 'curriculum_structure')->where('is_active', '1')->first();
        $educationalGoals = SiteManage::where('section', 'educational_goals')->where('is_active', '1')->first();
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

    <!-- Kurikulum Overview -->
    @if ($overview)
        <section class="py-16 px-5">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8 relative">
                    <div class="feature-badge">
                        <i class="fas fa-star"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-teal-800 mb-4">{{ $overview->title }}</h2>
                    <p class="text-gray-700 mb-6">{{ $overview->content }}</p>
                    <p class="text-gray-700 mb-8">{{ $overview->additional_content['description'] }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                        @foreach ($overview->additional_content['learning_approaches'] as $approach)
                            <div class="bg-teal-50 rounded-xl p-6 border border-teal-100">
                                <div class="flex items-center mb-4">
                                    <div class="bg-teal-100 text-teal-800 p-3 rounded-lg mr-4">
                                        {!! $approach['icon'] !!}
                                    </div>
                                    <h3 class="font-bold text-teal-800 text-lg">{{ $approach['title'] }}</h3>
                                </div>
                                <p class="text-gray-700">{{ $approach['description'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Curriculum Structure -->
    @if ($curriculumStructure)
        <section class="py-16 px-5">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-teal-800 mb-16 section-title">
                    {{ $curriculumStructure->title }}</h2>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    @foreach ($curriculumStructure->additional_content['curricula'] as $curriculum)
                        <div class="curriculum-card bg-white shadow-lg">
                            <div class="p-6 border-b-4 border-teal-500">
                                <div class="curriculum-icon bg-teal-100 text-teal-700 mx-auto">
                                    <i class="fas fa-book text-2xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-center text-teal-800 mb-4">{{ $curriculum['name'] }}</h3>
                                <p class="text-gray-600 text-center mb-6">{{ $curriculum['description'] }}</p>
                            </div>
                            <div class="p-6">
                                <ul class="space-y-3">
                                    @foreach ($curriculum['subjects'] as $subject)
                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-teal-500 mt-1 mr-3"></i>
                                            <span>{{ $subject }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Educational Goals -->
    @if ($educationalGoals)
        <section class="py-16 px-5 bg-gradient-to-r from-teal-50 to-emerald-50">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center text-teal-800 mb-16 section-title">{{ $educationalGoals->title }}
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- Goals List -->
                    <div class="space-y-6">
                        @foreach ($educationalGoals->additional_content['goals'] as $goal)
                            <div class="goal-item">
                                <div class="goal-icon bg-teal-100 text-teal-700">
                                    {!! $goal['icon'] !!}
                                </div>
                                <div class="goal-content">
                                    <h3 class="font-bold text-lg text-teal-800 mb-2">{{ $goal['title'] }}</h3>
                                    <p class="text-gray-700">{{ $goal['description'] }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-8 bg-white p-6 rounded-xl shadow-md border-l-4 border-teal-500">
                            <p class="text-gray-700 italic">
                                {!! $educationalGoals->additional_content['quote_icon'] !!}
                                {{ $educationalGoals->additional_content['quote'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Goals Image -->
                    <div class="flex items-center justify-center">
                        <div class="relative w-full max-w-md">
                            <div
                                class="aspect-w-1 aspect-h-1 bg-gradient-to-br from-teal-100 to-emerald-100 rounded-2xl shadow-xl p-8 flex flex-col items-center justify-center text-center">
                                <div class="mb-6">
                                    {!! $educationalGoals->additional_content['goals_images'][0]['icon'] !!}
                                </div>
                                <h3 class="text-2xl font-bold text-teal-800 mb-4">
                                    {{ $educationalGoals->additional_content['goals_images'][0]['title'] }}</h3>
                                <p class="text-gray-700 mb-6">
                                    {{ $educationalGoals->additional_content['goals_images'][0]['description'] }}
                                </p>
                                <div class="w-24 h-1 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-full mx-auto">
                                </div>

                                <div class="mt-8 grid grid-cols-3 gap-4">
                                    @foreach ($educationalGoals->additional_content['goals_images'][0]['points'] as $point)
                                        <div class="bg-white p-3 rounded-lg shadow-sm">
                                            {!! $point['icon'] !!}
                                            <p class="text-sm font-medium">{{ $point['name'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
