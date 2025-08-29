@extends('base.base-dash-index')
@section('menu')
    Pengumuman
@endsection
@section('submenu')
    Daftar Pengumuman
@endsection
@section('urlmenu')
    #
@endsection
@section('subdesc')
    Halaman untuk mengelola Pengumuman
@endsection
@section('content')
    <section class="flex flex-col md:flex-row gap-4">
        <div class="w-full">
            <div class="bg-white rounded-lg shadow-md">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-medium">@yield('menu')</h4>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200" id="notifyTable">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    #</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Judul Notifikasi</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th
                                    class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Author</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($notify as $key => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center whitespace-nowrap">{{ ++$key }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->name }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->type }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->desc }}</td>
                                    <td class="px-4 py-3 text-center">{{ $item->author->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $notify->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
