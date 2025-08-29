@extends('base.base-dash-index')
@section('title')
    Mahasantri Belum Bayar Bulanan - Siakad By Internal Developer
@endsection
@section('menu')
    Mahasantri Belum Bayar Bulanan
@endsection
@section('submenu')
    Lihat
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk melihat daftar mahasantri yang belum membayar biaya bulanan
@endsection
@section('content')
    <section class="p-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b">
                <div class="flex flex-col gap-2">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('menu')</h2>

                    <!-- Filter Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <form method="GET" action="{{ route($prefix . 'finance.pembayaran-unpaid-mahasantri') }}">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <!-- Search Field -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari
                                        Mahasantri</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-search text-gray-400"></i>
                                        </div>
                                        <input type="text" name="filter_name" placeholder="Nama Mahasantri"
                                            value="{{ request('filter_name') }}"
                                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-150">
                                    </div>
                                </div>

                                <!-- Enhanced Status Dropdown -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Pembayaran</label>
                                    <div class="relative">
                                        <select name="filter_status"
                                            class="appearance-none block w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500 bg-white cursor-pointer transition duration-150">
                                            <option value="all"
                                                {{ request('filter_status') == 'all' ? 'selected' : '' }}>Semua Status
                                            </option>
                                            <option value="paid"
                                                {{ request('filter_status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                                            <option value="unpaid"
                                                {{ request('filter_status') == 'unpaid' || !request('filter_status') ? 'selected' : '' }}>
                                                Belum Lunas</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Type Filter -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Tagihan</label>
                                    <div class="relative">
                                        <select name="filter_type"
                                            class="appearance-none block w-full pl-3 pr-10 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500 bg-white cursor-pointer transition duration-150">
                                            <option value="">Semua Jenis Tagihan</option>
                                            @foreach ($billTypes as $type)
                                                <option value="{{ $type }}"
                                                    {{ request('filter_type') == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-end gap-2">
                                    <button type="submit"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                        <i class="fas fa-filter mr-2"></i> Terapkan
                                    </button>
                                    <a href="{{ route($prefix . 'finance.pembayaran-unpaid-mahasantri') }}"
                                        class="flex-1 inline-flex justify-center items-center px-4 py-2.5 border border-gray-300 text-sm font-medium rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150">
                                        <i class="fas fa-sync-alt mr-2"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('sweetalert::alert')

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tagihan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mahasantri</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nominal</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $counter = 0; @endphp
                        @foreach ($bills as $billEntry)
                            @php
                                $filterName = request('filter_name');
                                $showRow = true;
                                if ($filterName) {
                                    $showRow =
                                        str_contains(
                                            strtolower($billEntry['student']->mhs_name),
                                            strtolower($filterName),
                                        ) ||
                                        str_contains(strtolower($billEntry['bill']->name), strtolower($filterName));
                                }
                            @endphp
                            @if ($showRow)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ++$counter }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium text-gray-900">{{ $billEntry['bill']->name ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $billEntry['bill']->type ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="font-medium">{{ $billEntry['student']->mhs_name ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">{{ $billEntry['student']->nim ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap uppercase font-mono">
                                        {{ $billEntry['bill']->code }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                        <div class="font-medium">Rp
                                            {{ number_format($billEntry['bill']->price, 0, ',', '.') }}</div>
                                        @if ($billEntry['bill']->scholarship_percentage > 0)
                                            <div class="text-xs text-gray-500">
                                                Potongan: Rp {{ number_format($billEntry['bill']->discount, 0, ',', '.') }}
                                            </div>
                                            <div class="text-xs font-semibold text-green-600">
                                                Dibayar: Rp
                                                {{ number_format($billEntry['bill']->finalAmount, 0, ',', '.') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if (isset($billEntry['bill']->paid) && $billEntry['bill']->paid)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> LUNAS
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <i class="fas fa-times-circle mr-1"></i> BELUM LUNAS
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if (!$billEntry['bill']->paid)
                                            <form method="POST"
                                                action="{{ route($prefix . 'finance.pembayaran-unpaid-mahasantri-mark-paid', ['code' => $billEntry['bill']->code, 'userId' => $billEntry['student']->id]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700 transition-colors text-sm"
                                                    onclick="return confirm('Tandai tagihan ini sebagai lunas?')">
                                                    <i class="fas fa-check mr-1"></i> Tandai Lunas
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST"
                                                action="{{ route($prefix . 'finance.pembayaran-unpaid-mahasantri-mark-unpaid', ['code' => $billEntry['bill']->code, 'userId' => $billEntry['student']->id]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition-colors text-sm"
                                                    onclick="return confirm('Batalkan status lunas tagihan ini?')">
                                                    <i class="fas fa-undo mr-1"></i> Batal
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @if (count($bills) == 0)
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center py-4">
                                        <i class="fas fa-file-invoice-dollar text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-lg">Tidak ada data tagihan</p>
                                        <p class="text-sm text-gray-500">Semua tagihan sudah lunas atau tidak ada data yang
                                            cocok dengan filter</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
