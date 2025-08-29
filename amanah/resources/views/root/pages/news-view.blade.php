@extends('base.base-root-index')
@section('content')
    <div class="min-h-screen bg-gray-50 py-12">
        <!-- Main Content Container -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Card -->
            <article class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Featured Image Container - Maintains aspect ratio -->
                <div class="relative w-full" style="padding-top: 56.25%;"> <!-- 16:9 aspect ratio -->
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->name }}"
                        class="absolute top-0 left-0 w-full h-full object-cover" loading="lazy">
                    <!-- Image overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <!-- Title and meta positioned over image -->
                    <div class="absolute bottom-0 left-0 p-6 w-full">
                        <div class="max-w-3xl mx-auto text-center">
                            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $post->name }}</h1>
                            <div class="flex flex-wrap items-center justify-center gap-x-4 text-white/90 text-sm">
                                <span>{{ $post->created_at->translatedFormat('l, d F Y - H.i') }} WIB</span>
                                <span class="hidden sm:inline">•</span>
                                <span>By <a href="#"
                                        class="hover:text-white transition-colors">{{ $post->author->name }}</a></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Article Content -->
                <div class="max-w-2xl mx-auto px-6 py-8">
                    <style>
                        /* Ensure lists inside prose have proper styles */
                        .prose ul {
                            list-style-type: disc;
                            padding-left: 1.25rem;
                            margin-top: 1rem;
                            margin-bottom: 1rem;
                        }

                        .prose ol {
                            list-style-type: decimal;
                            padding-left: 1.25rem;
                            margin-top: 1rem;
                            margin-bottom: 1rem;
                        }

                        .prose li {
                            margin-top: 0.25rem;
                            margin-bottom: 0.25rem;
                        }
                    </style>
                    <div class="prose prose-lg max-w-none">
                        {!! $post->content !!}
                    </div>

                    <!-- Article Footer -->
                    <div class="mt-12 pt-6 border-t border-gray-100">
                        <div class="flex flex-col items-center space-y-2 text-sm text-gray-500">
                            <span>Category:
                                <a href="#" class="text-blue-600 hover:underline">{{ $post->category->name }}</a>
                            </span>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>

    <!-- Notification Modals -->
    @foreach ($notify as $item)
        <!-- Modal Backdrop -->
        <div id="updateFakultas{{ $item->code }}"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 invisible opacity-0 transition-all duration-300"
            x-data="{ open: false }" x-ref="modal" :class="{ 'visible opacity-100': open }"
            @keydown.escape.window="open = false" style="backdrop-filter: blur(4px);">
            <!-- Modal Dialog -->
            <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden transform transition-all duration-300 scale-95"
                x-show="open" @click.away="open = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b">
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-800">
                        <span class="text-blue-600">Notifikasi</span> • {{ $item->name }}
                    </h3>
                    <button @click="open = false" class="p-1 rounded-full hover:bg-gray-100 transition-colors"
                        aria-label="Close modal">
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 max-h-[70vh] overflow-y-auto">
                    <div class="space-y-4">
                        <div class="prose max-w-none">
                            {!! $item->desc !!}
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end p-4 bg-gray-50">
                    <button @click="open = false"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endforeach
@endsection
