@extends('layouts.app')

@section('content')
<div class="py-8 px-4 max-w-7xl mx-auto">

    <!-- Top 4 Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Pinjam Buku (Active) -->
        <div class="bg-white rounded-xl shadow-sm border-2 border-[#1e3a8a] flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#1e3a8a] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Pinjam Buku</span>
        </div>

        <!-- Kembalikan Buku -->
        <a href="{{ route('siswa.kembali') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#10b981] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Kembalikan Buku</span>
        </a>

        <!-- Cari Buku -->
        <a href="{{ route('siswa.dashboard') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-blue-500 p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Cari Buku</span>
        </a>

        <!-- Riwayat -->
        <a href="{{ route('siswa.riwayat') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#a855f7] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Riwayat</span>
        </a>
    </div>

    <!-- Main Card Body -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        <!-- Header -->
        <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            <h2 class="text-xl font-bold text-gray-700">Pinjam Buku</h2>
        </div>

        <div class="max-w-4xl mx-auto">
            <!-- Rules Alert -->
            <div class="bg-[#f0f7ff] border border-[#d6e8ff] rounded-xl p-5 mb-8 flex gap-4">
                <div class="text-blue-600 shrink-0 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h3 class="font-semibold text-blue-900 mb-2">Ketentuan Peminjaman:</h3>
                    <ul class="list-disc pl-5 space-y-1 text-blue-800 text-sm">
                        <li>Maksimal peminjaman 7 hari</li>
                        <li>Denda keterlambatan Rp 1.000/hari</li>
                        <li>Maksimal meminjam 3 buku sekaligus</li>
                    </ul>
                </div>
            </div>

            <!-- Form Pinjam -->
            <form action="" method="POST">
                @csrf

                <!-- Pilih Buku -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Buku <span class="text-red-500">*</span></label>
                    <select name="book_id" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-white shadow-sm" required>
                        <option value="" disabled selected>Pilih buku yang ingin dipinjam</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}">{{ $book->judul }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Pinjam <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Kembali <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime('+7 days')) }}" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-gray-700 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 shadow-sm" required>
                    </div>
                </div>

                <!-- Durasi Info -->
                <div class="flex items-center text-sm text-gray-500 mb-8 font-medium">
                    <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Durasi peminjaman: 7 hari
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3 px-4 bg-[#1e3a8a] hover:bg-blue-900 text-white font-semibold rounded-lg shadow-sm transition flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Ajukan Peminjaman
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
