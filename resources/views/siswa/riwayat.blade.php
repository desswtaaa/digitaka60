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

        <a href="{{ route('siswa.kembali') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#10b981] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Kembalikan Buku</span>
        </a>

        <a href="{{ route('siswa.dashboard') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-blue-500 p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Cari Buku</span>
        </a>

        <div class="bg-white rounded-xl shadow-sm border-2 border-[#1e3a8a] flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#a855f7] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Riwayat</span>
        </div>
    </div>


    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @php
            $countSemua = count($riwayat);
            $countDikembalikan = $riwayat->where('status', 'dikembalikan')->count();
            
            // Hitung terlambat (status dipinjam & tanggal_kembali < hari ini)
            $countTerlambat = $riwayat->filter(function($item) {
                return $item->status == 'dipinjam' && \Carbon\Carbon::parse($item->tanggal_kembali)->isPast();
            })->count();
            
            // Dipinjam normal (tidak terlambat)
            $countDipinjam = $riwayat->where('status', 'dipinjam')->count() - $countTerlambat;
        @endphp

        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <h2 class="text-xl font-bold text-gray-800">Riwayat</h2>
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap gap-3 mb-6" id="filterContainer">
            <button data-filter="semua" class="filter-btn px-5 py-2 bg-[#1e3a8a] text-white text-sm font-medium rounded-full transition">Semua ({{ $countSemua }})</button>
            <button data-filter="dipinjam" class="filter-btn px-5 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 text-sm font-medium rounded-full transition">Dipinjam ({{ $countDipinjam }})</button>
            <button data-filter="dikembalikan" class="filter-btn px-5 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 text-sm font-medium rounded-full transition">Dikembalikan ({{ $countDikembalikan }})</button>
            <button data-filter="terlambat" class="filter-btn px-5 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 text-sm font-medium rounded-full transition">Terlambat ({{ $countTerlambat }})</button>
        </div>

        <p class="text-sm text-gray-400 font-medium mb-6" id="countText">Menampilkan {{ $countSemua }} transaksi</p>

        <!-- List Riwayat -->
        <div class="flex flex-col gap-4">
            @forelse($riwayat as $transaksi)
                @php
                    $isTerlambat = $transaksi->status == 'dipinjam' && \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast();
                    $itemFilterStatus = $transaksi->status == 'dikembalikan' ? 'dikembalikan' : ($isTerlambat ? 'terlambat' : 'dipinjam');
                @endphp
                
                <div class="riwayat-item border border-gray-100 rounded-2xl p-5 flex flex-col md:flex-row justify-between items-start md:items-center bg-white hover:border-gray-200 hover:shadow-sm transition gap-4" data-status="{{ $itemFilterStatus }}">
                    
                    <div class="flex gap-4 items-start w-full">
                        <div class="bg-blue-50 p-3 rounded-xl text-blue-500 shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        
                        <div class="flex flex-col w-full">
                            <h3 class="font-bold text-gray-800 text-lg leading-tight mb-2">{{ $transaksi->book->judul ?? 'Buku Dihapus' }}</h3>
                            <div class="text-gray-400 text-sm flex items-center gap-2 mb-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Pinjam: {{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('d/m/Y') }}
                            </div>
                            <div class="text-gray-400 text-sm flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Kembali: {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d/m/Y') }}
                            </div>

                            @if($isTerlambat)
                                <div class="text-red-500 text-xs font-bold mt-3">
                                    Denda: Rp 5.000
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="shrink-0 mt-2 md:mt-0 ml-14 md:ml-0">
                        @if($transaksi->status == 'dikembalikan')
                            <span class="bg-[#10b981] text-white px-4 py-1.5 text-xs font-bold rounded-full text-center inline-block w-28">Dikembalikan</span>
                        @elseif($isTerlambat)
                            <span class="bg-red-500 text-white px-4 py-1.5 text-xs font-bold rounded-full text-center inline-block w-28">Terlambat</span>
                        @else
                            <span class="bg-blue-500 text-white px-4 py-1.5 text-xs font-bold rounded-full text-center inline-block w-28">Dipinjam</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-gray-50 rounded-xl border border-gray-100">
                    <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <p class="text-gray-500 font-medium">Belum ada riwayat transaksi</p>
                </div>
            @endforelse
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const riwayatItems = document.querySelectorAll('.riwayat-item');
    const countText = document.getElementById('countText');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Reset state of all buttons
            filterButtons.forEach(btn => {
                btn.classList.remove('bg-[#1e3a8a]', 'text-white');
                btn.classList.add('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
            });

            // Set active shape for clicked button
            this.classList.remove('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
            this.classList.add('bg-[#1e3a8a]', 'text-white');

            const selectedFilter = this.getAttribute('data-filter');
            let visibleCount = 0;

            riwayatItems.forEach(item => {
                // If filter is 'semua' or the item matches the selected status
                if (selectedFilter === 'semua' || item.getAttribute('data-status') === selectedFilter) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            // Update bottom text
            countText.textContent = `Menampilkan ${visibleCount} transaksi`;
        });
    });
});
</script>
@endsection
