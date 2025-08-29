@extends('base.base-root-index')

@section('submenu')
    Lihat Gallery {{ $album->name }}
@endsection

@section('content')
    {{-- Breadcrumb and Hero Banner Section --}}
    <div class="relative w-full h-56 sm:h-72 lg:h-96 bg-cover bg-center rounded-b-3xl overflow-hidden shadow-2xl mb-10"
        style="background-image: url('https://srv-xsample.internal-dev.id/assets/webprofil/media/banner/banner22.jpg');">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/60 to-transparent flex flex-col justify-end items-center p-6 text-center">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="flex flex-wrap justify-center items-center text-sm sm:text-base text-white opacity-90 space-x-3">
                    <li class="breadcrumb-item">
                        <a href="{{ route('root.home-index') }}"
                            class="inline-flex items-center px-5 py-2 bg-blue-700 text-white font-medium rounded-full shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-1">
                            <i class="fas fa-home mr-2"></i> <span>Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <a href="{{ route('root.gallery-index') }}"
                            class="inline-flex items-center px-5 py-2 bg-green-700 text-white font-medium rounded-full shadow-lg hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300 transform hover:-translate-y-1 ml-3">
                            <i class="fas fa-images mr-2"></i> <span>Album Foto</span>
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight drop-shadow-lg animate-fade-in-up">
                @yield('submenu')
            </h1>
        </div>
    </div>

    <section class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
            {{-- Album Cover & Title Card --}}
            <div class="lg:col-span-1 text-center">
                <div class="relative group cursor-pointer bg-white rounded-3xl shadow-2xl overflow-hidden transform transition-transform duration-500 hover:scale-105 hover:shadow-3xl">
                    <img class="w-full h-auto object-cover rounded-3xl transition-opacity duration-300 group-hover:opacity-80"
                        src="{{ asset('storage/' . $album->cover) }}" alt="Cover Album {{ $album->name }}"
                        data-bs-toggle="modal" data-bs-target="#galleryModal" data-img-src="{{ asset('storage/' . $album->cover) }}"
                        data-img-alt="Cover Album {{ $album->name }}">
                    <div class="absolute inset-0 bg-black bg-opacity-70 flex items-center justify-center text-white text-3xl font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-3xl p-4">
                        {{ $album->name }}
                    </div>
                </div>
            </div>

            {{-- Album Description Card --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-2xl p-8 transform transition-transform duration-300 hover:scale-[1.01] hover:shadow-3xl">
                    <h2 class="text-4xl font-bold text-gray-800 mb-5 border-b-4 border-blue-500 pb-3 inline-block">
                        Album: {{ $album->name }}
                    </h2>
                    <p class="text-gray-700 leading-relaxed text-lg sm:text-xl">
                        {{ $album->desc }}
                    </p>
                </div>
            </div>
        </div>

        <hr class="my-12 border-t-4 border-gray-200 rounded-full">

        {{-- Photo Gallery Grid --}}
        <h3 class="text-4xl font-bold text-gray-800 mb-8 text-center animate-fade-in">Jelajahi Koleksi Foto Ini</h3>
        @if ($album->file_1 || $album->file_2 || $album->file_3 || $album->file_4 || $album->file_5 || $album->file_6 || $album->file_7 || $album->file_8 || $album->file_9 || $album->file_10 || $album->file_11 || $album->file_12 || $album->file_13 || $album->file_14 || $album->file_15 || $album->file_16 || $album->file_17 || $album->file_18 || $album->file_19 || $album->file_20)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @for ($i = 1; $i <= 20; $i++)
                    @if ($album->{'file_' . $i})
                        <div class="relative group cursor-pointer">
                            <img class="w-full h-64 object-cover rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-105 group-hover:shadow-xl"
                                src="{{ asset('storage/' . $album->{'file_' . $i}) }}"
                                alt="Gallery Foto {{ $i }}"
                                data-bs-toggle="modal" data-bs-target="#galleryModal"
                                data-img-src="{{ asset('storage/' . $album->{'file_' . $i}) }}"
                                data-img-alt="Gallery Foto {{ $i }}">
                            <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center text-white text-xl font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl">
                                Lihat Foto {{ $i }}
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        @else
            <div class="bg-gradient-to-br from-gray-50 to-gray-200 p-10 rounded-2xl text-center text-gray-700 shadow-xl border border-gray-300">
                <i class="fas fa-camera-retro text-6xl mb-5 text-gray-500 animate-bounce-in"></i>
                <p class="text-2xl font-bold mb-2">Belum ada foto di album ini.</p>
                <p class="text-lg">Album ini mungkin baru saja dibuat atau sedang dalam proses pengisian.</p>
                <p class="mt-4 text-sm text-gray-500">Kami akan segera menambahkan kenangan indah di sini!</p>
            </div>
        @endif

        {{-- Pagination (if you implement it later) --}}
        {{-- <div class="mt-12 text-center">
            {{ $album->links() }}
        </div> --}}
    </section>

    {{-- Gallery Modal (for larger image view) --}}
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body p-0">
                    <img src="" id="modalImage" class="w-full h-auto max-h-[90vh] object-contain rounded-lg shadow-2xl"
                        alt="Gallery Image">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Bootstrap Modal for image display
                const galleryModal = document.getElementById('galleryModal');
                const modalImage = document.getElementById('modalImage');

                galleryModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal
                    const imgSrc = button.getAttribute('data-img-src');
                    const imgAlt = button.getAttribute('data-img-alt');

                    modalImage.src = imgSrc;
                    modalImage.alt = imgAlt;
                });
            });
        </script>
    @endpush
@endsection