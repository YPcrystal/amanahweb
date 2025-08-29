@extends('base.base-dash-index')

@section('title', 'Kelola Beasiswa Mahasiswa')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Header Section -->
            <div class="mb-6 pb-4 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">
                    Kelola Beasiswa untuk:
                    <span class="text-blue-600">{{ $student->mhs_name }}</span>
                    <span class="text-gray-600">({{ $student->mhs_nim }})</span>
                </h1>
                <p class="text-gray-600 mt-1">
                    Program Studi: {{ $student->studyProgram->name ?? '-' }}
                </p>
            </div>

            @include('sweetalert::alert')

            <!-- Student Bills Table -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                    <i class="fas fa-receipt mr-2 text-blue-500"></i>Tagihan Mahasiswa
                </h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kode Tagihan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Tagihan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nominal</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Beasiswa</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tipe Beasiswa</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($bills as $bill)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $bill->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $bill->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                        <div class="font-medium">Rp {{ number_format($bill->price, 0, ',', '.') }}</div>
                                        @if ($bill->scholarship_percentage > 0)
                                            <div class="text-xs text-gray-500">
                                                Potongan: Rp {{ number_format($bill->discount, 0, ',', '.') }}
                                            </div>
                                            <div class="text-xs font-semibold text-green-600">
                                                Dibayar: Rp {{ number_format($bill->finalAmount, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($bill->scholarship_percentage > 0)
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ $bill->scholarship_percentage }}%
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                0%
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $bill->scholarship_type ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $bill->scholarship_note ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Scholarship Form -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">
                    <i class="fas fa-plus-circle mr-2 text-blue-500"></i>Tambah/Ubah Beasiswa
                </h2>

                <form action="{{ route($prefix . 'finance.scholarship-store', $student->id) }}" method="POST"
                    class="space-y-4">
                    @csrf

                    <div>
                        <label for="tagihan_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Jenis Tagihan
                            <span class="text-gray-400 text-xs">(kosongkan untuk semua tagihan)</span>
                        </label>
                        <select name="tagihan_id" id="tagihan_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                            <option value="">Semua Tagihan</option>
                            @foreach ($bills as $bill)
                                <option value="{{ $bill->id }}">{{ $bill->code }} - {{ $bill->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="scholarship_percentage" class="block text-sm font-medium text-gray-700 mb-1">
                            Persentase Beasiswa (%)
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="number" name="scholarship_percentage" id="scholarship_percentage" min="0"
                                max="100" value="0" step="1"
                                class="focus:ring-blue-500 focus:border-blue-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">%</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="scholarship_type" class="block text-sm font-medium text-gray-700 mb-1">
                            Tipe Beasiswa
                        </label>
                        <input type="text" name="scholarship_type" id="scholarship_type"
                            class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Contoh: Beasiswa Prestasi">
                    </div>

                    <div>
                        <label for="scholarship_note" class="block text-sm font-medium text-gray-700 mb-1">
                            Catatan
                        </label>
                        <textarea name="scholarship_note" id="scholarship_note" rows="3"
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Keterangan tambahan tentang beasiswa ini"></textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>Simpan Beasiswa
                        </button>
                        <a href="{{ route($prefix . 'finance.scholarship-index') }}"
                            class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
