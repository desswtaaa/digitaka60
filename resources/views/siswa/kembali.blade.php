@extends('layouts.app')

@section('content')
<div class="py-8 px-4 max-w-7xl mx-auto">

    <!-- Navbar Kotak-Kotak Atas -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('siswa.pinjam') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#1e3a8a] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Pinjam Buku</span>
        </a>

        <!-- Menu Kembalikan Buku (AKTIF) -->
        <div class="bg-white rounded-xl shadow-sm border-2 border-[#1e3a8a] flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#10b981] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Kembalikan Buku</span>
        </div>

        <a href="{{ route('siswa.dashboard') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-blue-500 p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Cari Buku</span>
        </a>

        <a href="{{ route('siswa.riwayat') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#a855f7] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Riwayat</span>
        </a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex items-center gap-3 mb-2">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
            <h2 class="text-xl font-bold text-gray-800">Kembalikan Buku</h2>
        </div>
        
        <p class="text-sm text-gray-400 font-medium mb-8">Anda memiliki {{ count($peminjaman) }} buku yang sedang dipinjam</p>

        <!-- List Buku Yang Sedang Dipinjam -->
        <div class="flex flex-col gap-6">
            @forelse($peminjaman as $transaksi)
                @php
                    $isTerlambat = \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast();
                    $hariTerlambat = $isTerlambat ? \Carbon\Carbon::parse($transaksi->tanggal_kembali)->diffInDays(\Carbon\Carbon::now()) : 0;
                    // denda Rp 1000 / hari
                    $denda = $hariTerlambat * 1000;
                @endphp

                <div class="border rounded-xl p-5 bg-white relative overflow-hidden shadow-sm transition
                    {{ $isTerlambat ? 'border-red-300' : 'border-gray-200' }}">
                    
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex flex-col">
                            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $transaksi->book->judul ?? 'Buku Dihapus' }}</h3>
                            
                            <div class="text-gray-500 text-sm flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Dipinjam: {{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d/m/Y') }}
                            </div>
                            
                            <div class="text-gray-500 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Kembali: {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d/m/Y') }}
                            </div>
                        </div>

                        <!-- Badge Terlambat -->
                        @if($isTerlambat)
                            <div class="bg-red-600 text-white px-3 py-1 text-xs font-bold rounded-md flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Terlambat {{ $hariTerlambat }} hari
                            </div>
                        @else
                            <div class="bg-blue-100 text-blue-700 px-3 py-1 text-xs font-bold rounded-md flex items-center gap-1">
                                <!-- Info badge -->
                                Tepat Waktu
                            </div>
                        @endif
                    </div>

                    <!-- Peringatan Denda -->
                    @if($isTerlambat && $denda > 0)
                    <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mb-4">
                        <div class="font-bold">Denda Keterlambatan</div>
                        <div>Rp {{ number_format($denda, 0, ',', '.') }}</div>
                    </div>
                    @endif

                    <form action="{{ route('siswa.kembali.store', $transaksi->id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="w-full py-3 px-4 text-white text-sm font-bold rounded-lg shadow-sm transition
                                {{ $isTerlambat ? 'bg-red-600 hover:bg-red-700' : 'bg-[#1e3a8a] hover:bg-blue-900' }} flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Kembalikan Buku
                        </button>
                    </form>
                </div>

            @empty
                <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-100">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <p class="text-gray-500 font-medium">Bagus! Anda tidak memiliki buku yang sedang dipinjam.</p>
                </div>
            @endforelse
        </div>

    </div>

</div>
@endsection
