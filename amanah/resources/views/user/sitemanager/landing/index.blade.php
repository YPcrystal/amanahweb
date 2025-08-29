@extends('base.base-dash-index')
@section('title')
    Dashboard Admin - Internal Developer
@endsection
@section('menu')
    Dashboard
@endsection
@section('submenu')
    Landing Page Content
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Manage all landing page sections and content
@endsection
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-5 bg-white border-b border-gray-200">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <!-- Title Section -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900">
                            @switch(request('order'))
                                @case(1)
                                    Landing Page Content
                                @break

                                @case(2)
                                    Tentang Kami
                                @break

                                @case(3)
                                    Kurikulum
                                @break

                                @case(4)
                                    Kompetensi Programmer
                                @break

                                @case(5)
                                    Kompetensi Desain
                                @break

                                @default
                                    All Content
                            @endswitch
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">Manage your page sections</p>
                    </div>

                    <!-- Filter Section -->
                    <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center">
                        <form method="GET" action="{{ route($prefix . 'landing-page.index') }}"
                            class="flex flex-col sm:flex-row gap-3 w-full">
                            <!-- View Type Filter -->
                            <div class="flex-1">
                                <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Page Type</label>
                                <div class="relative">
                                    <select name="order" id="order"
                                        class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                        onchange="this.form.submit()">
                                        <option value="">All Pages</option>
                                        <option value="1" {{ request('order') == '1' ? 'selected' : '' }}>Landing Page
                                        </option>
                                        <option value="2" {{ request('order') == '2' ? 'selected' : '' }}>Tentang Kami
                                        </option>
                                        <option value="3" {{ request('order') == '3' ? 'selected' : '' }}>Kurikulum
                                        </option>
                                        <option value="4" {{ request('order') == '4' ? 'selected' : '' }}>Kompetensi
                                            Programmer</option>
                                        <option value="5" {{ request('order') == '5' ? 'selected' : '' }}>Kompetensi
                                            Desain</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </div>


                            <!-- Reset Button -->
                            @if (request('order') || request('section_order'))
                                <div class="flex items-end">
                                    <a href="{{ route($prefix . 'landing-page.index') }}"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors h-[42px]">
                                        <svg class="-ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Reset
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Section</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Content Preview</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($contents as $content)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ Str::title(str_replace('_', ' ', $content->section)) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $content->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 max-w-xs truncate">
                                        {{ $content->content }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($content->image_path)
                                        <img src="{{ asset($content->image_path) }}" alt="Preview"
                                            class="h-10 w-auto rounded-md border border-gray-200">
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $content->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $content->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route($prefix . 'landing-page.edit', $content->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- @if ($contents->hasPages())
                <div class="px-6 py-4 border-t border-light-200">
                    {{ $contents->links() }}
                </div>
            @else
                <div class="px-6 py-4 text-gray-500">
                    Tidak ada halaman tambahan.
                </div>
            @endif --}}
        </div>
    </div>
@endsection
