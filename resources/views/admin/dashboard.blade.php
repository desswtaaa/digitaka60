@extends('layouts.app')

@section('content')

<style>
/* RESET DASAR */
body {
    margin: 0;
    overflow-x: hidden;
    background-color: #f1f5f9; /* biar soft */
    font-family: sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #1e3a8a;
    color: white;
    overflow-y: auto;
    z-index: 1000;
}

/* SCROLLBAR SIDEBAR */
.sidebar::-webkit-scrollbar {
    width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.2);
    border-radius: 10px;
}

/* LOGO */
.logo-box {
    width: 45px;
    height: 45px;
    background-color: #10b981;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* MENU SIDEBAR */
.sidebar a {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #cbd5e1;
    text-decoration: none;
    border-radius: 8px;
    margin: 5px 15px;
    font-size: 15px;
    font-weight: 500;
    gap: 12px;
    transition: 0.2s;
}

.sidebar a.active,
.sidebar a:hover {
    background: #2563eb;
    color: white;
}

/* CONTENT */
.content {
    margin-left: 260px;
    min-height: 100vh;
    padding: 20px;
}

/* JIKA ADA NAVBAR ATAS (optional) */
.navbar-custom {
    position: fixed;
    top: 0;
    left: 260px;
    right: 0;
    height: 70px;
    background: #1e3a8a;
    z-index: 999;
}

/* Kalau pakai navbar, aktifkan ini */
.content.with-navbar {
    margin-top: 70px;
}

/* CARD / WRAPPER */
.table-wrapper {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* BUTTON */
.btn-primary-custom {
    background-color: #1e3a8a;
    color: white;
    border: none;
}
.btn-primary-custom:hover {
    background-color: #152c6b;
    color: white;
}
</style>

<div class="d-flex w-100">

    <!-- SIDEBAR -->
    <div class="sidebar py-4 d-flex flex-column">
        <div class="d-flex align-items-center justify-content-center px-4 mb-4 pb-3 border-bottom border-primary border-opacity-25">
            <img src="{{ asset('image/logoteks.png') }}" alt="Digitaka" style="max-width: 100%; height: auto; max-height: 50px;">
        </div>

        <div class="flex-grow-1 mt-2">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.books') }}" class="{{ request()->routeIs('admin.books') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Buku
            </a>
            <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Kategori
            </a>
            <a href="{{ route('admin.anggota') }}" class="{{ request()->routeIs('admin.anggota') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Anggota
            </a>
            <a href="{{ route('admin.peminjaman') }}" class="{{ request()->routeIs('admin.peminjaman') ? 'active' : '' }}">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                Transaksi
            </a>

        </div>
        
        <div class="px-3 mt-auto mb-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="border-0 bg-transparent w-100 text-start text-danger" style="padding: 12px 20px; font-weight: 500; font-size: 15px; margin: 5px 15px; display: flex; align-items: center; gap: 12px; text-decoration: none;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="text-danger"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>

    <!-- 🔶 CONTENT -->
    <div class="content p-4 w-100" style="background-color: #f8fafc; min-height: 100vh;">
        <div class="mb-4">
            <h4 class="fw-bold fs-4 mb-1" style="color: #0f172a;">Dashboard</h4>
            <p class="text-muted" style="font-size: 14px;">Selamat datang, admin</p>
        </div>

        <!-- 🔢 CARD STAT -->
        <div class="row g-3 mb-4">

            <div class="col-md-3">
                <div class="card card-stat border-0 rounded-4 shadow-sm h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2" style="font-size: 13px;">Total Buku</h6>
                            <h3 class="fw-bold mb-1" style="color: #0f172a;">{{ $totalBuku }}</h3>
                            <small class="text-muted" style="font-size: 12px;">{{ $judulBerbeda }} judul berbeda</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #e0e7ff; color: #4f46e5;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stat border-0 rounded-4 shadow-sm h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2" style="font-size: 13px;">Anggota Aktif</h6>
                            <h3 class="fw-bold mb-1" style="color: #0f172a;">{{ $anggotaAktif }}</h3>
                            <small class="text-muted" style="font-size: 12px;">Siswa terdaftar</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #dcfce7; color: #16a34a;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stat border-0 rounded-4 shadow-sm h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2" style="font-size: 13px;">Sedang Dipinjam</h6>
                            <h3 class="fw-bold mb-1" style="color: #0f172a;">{{ $sedangDipinjam }}</h3>
                            <small class="text-muted" style="font-size: 12px;">Transaksi aktif</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #ccfbf1; color: #0d9488;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-stat border-0 rounded-4 shadow-sm h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2" style="font-size: 13px;">Terlambat</h6>
                            <h3 class="fw-bold mb-1" style="color: #0f172a;">{{ $terlambat }}</h3>
                            <small class="text-muted" style="font-size: 12px;">Perlu tindak lanjut</small>
                        </div>
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; background-color: #fef3c7; color: #d97706;">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-4">
            <!-- 🔁 TRANSAKSI TERBARU -->
            <div class="col-lg-7">
                <div class="card border-0 p-4 rounded-4 shadow-sm h-100">
                    <h6 class="fw-bold mb-4" style="color: #334155;">Transaksi Terbaru</h6>

                    <div class="d-flex flex-column gap-3">
                        @forelse($transaksiTerbaru as $transaksi)
                            @php
                                $isTerlambat = $transaksi->status == 'dipinjam' && \Carbon\Carbon::parse($transaksi->tanggal_kembali)->isPast();
                            @endphp
                            <div class="d-flex justify-content-between align-items-center border p-3 rounded-4" style="border-color: #f1f5f9 !important;">
                                <div>
                                    <strong style="color: #1e293b;">{{ $transaksi->book->judul ?? 'Buku Dihapus' }}</strong><br>
                                    <small style="color: #64748b;">Dipinjam oleh: {{ $transaksi->user->name ?? 'Anggota Dihapus' }}</small><br>
                                    <small class="text-muted" style="font-size: 11px;">{{ \Carbon\Carbon::parse($transaksi->tanggal_pinjam)->format('Y-m-d') }} - {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('Y-m-d') }}</small>
                                </div>
                                <div class="my-auto">
                                    @if($transaksi->status == 'dikembalikan')
                                        <span class="badge rounded-pill my-auto" style="background-color: #dcfce7; color: #16a34a; font-weight: 500; padding: 6px 12px;">Dikembalikan</span>
                                    @elseif($isTerlambat)
                                        <span class="badge rounded-pill my-auto" style="background-color: #fee2e2; color: #ef4444; font-weight: 500; padding: 6px 12px;">Terlambat</span>
                                    @else
                                        <span class="badge rounded-pill my-auto" style="background-color: #e0e7ff; color: #4f46e5; font-weight: 500; padding: 6px 12px;">Dipinjam</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <p class="mb-0">Belum ada transaksi</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- 📚 BUKU POPULER -->
            <div class="col-lg-5">
                <div class="card border-0 p-4 rounded-4 shadow-sm h-100">
                    <h6 class="fw-bold mb-4" style="color: #334155;">Buku Populer</h6>

                    <ul class="list-group list-group-flush d-flex flex-column gap-3">
                        @forelse($bukuPopuler as $buku)
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3 rounded-4 border" style="border-color: #f1f5f9 !important;">
                            <div class="d-flex align-items-center gap-3">
                                <div class="p-2 rounded-3" style="background-color: #f8fafc; color: #64748b;">
                                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold" style="color: #334155; font-size: 14px;">{{ $buku->judul }}</h6>
                                    <small style="color: #64748b; font-size: 12px;">{{ $buku->penulis }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <strong class="d-block" style="color: #1e293b; font-size: 13px;">Stok: {{ $buku->stok }}</strong>
                                <small style="color: #64748b; font-size: 11px;">{{ $buku->category->category_name ?? '-' }}</small>
                            </div>
                        </li>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <p class="mb-0">Belum ada buku tersedia</p>
                            </div>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
