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
            <h4 class="fw-bold" style="color: #0f172a;">Kategori</h4>
            <p class="text-muted">Kelola jenis kategori buku</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-wrapper">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div class="input-group" style="max-width: 500px;">
                    <span class="input-group-text bg-white border-end-0 text-secondary"><svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></span>
                    <input type="text" id="searchCategory" class="form-control border-start-0 ps-0 shadow-none" placeholder="Cari kategori...">
                </div>
                <button class="btn btn-primary-custom rounded-3 px-3 py-2 fw-medium" data-bs-toggle="modal" data-bs-target="#createModal">
                    + Tambah Kategori
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mt-3 align-middle text-nowrap">
                    <thead style="color: #475569; font-size: 14px;">
                        <tr>
                            <th class="fw-medium pb-3 border-bottom-0" width="10%">ID</th>
                            <th class="fw-medium pb-3 border-bottom-0">Nama Kategori</th>
                            <th class="fw-medium pb-3 border-bottom-0 text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody style="border-top: 1px solid #f1f5f9;">
                        @foreach($categories as $category)
                        <tr class="category-row">
                            <td class="py-3" style="color: #475569;">{{ $category->id }}</td>
                            <td class="py-3 searchable" style="color: #334155;">{{ $category->category_name }}</td>
                            <td class="py-3 text-end">
                                <button class="btn btn-sm text-secondary p-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}" title="Edit">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.89 1.14l-2.812.938.938-2.812a4.5 4.5 0 011.14-1.89l12.654-12.654z" /></svg>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Pastikan tidak ada buku yang terhubung.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-secondary p-1" title="Hapus">
                                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header border-bottom-0 pb-0 mt-2 px-4">
                                            <h5 class="modal-title fw-bold fs-5" style="color: #0f172a;">Edit Kategori</h5>
                                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body px-4 pt-1">
                                            <p class="text-muted mb-4" style="font-size: 14px;">Ubah nama kategori buku</p>
                                            <div class="mb-3">
                                                <label class="form-label" style="font-size: 14px; color: #334155;">Nama Kategori <span class="text-danger">*</span></label>
                                                <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                                            <button type="button" class="btn btn-outline-secondary px-4 bg-white" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary-custom px-4">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-header border-bottom-0 pb-0 mt-2 px-4">
                    <h5 class="modal-title fw-bold fs-5" style="color: #0f172a;">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pt-1">
                    <p class="text-muted mb-4" style="font-size: 14px;">Masukkan rincian kategori buku baru</p>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 14px; color: #334155;">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="category_name" class="form-control" placeholder="Contoh: Fiksi, Sains..." required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-outline-secondary px-4 bg-white" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary-custom px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Search filter
    document.getElementById('searchCategory').addEventListener('keyup', function(e) {
        let value = e.target.value.toLowerCase();
        let rows = document.querySelectorAll('.category-row');
        rows.forEach(row => {
            let matches = false;
            let cols = row.querySelectorAll('.searchable');
            cols.forEach(col => {
                if(col.innerText.toLowerCase().includes(value)) {
                    matches = true;
                }
            });
            row.style.display = matches ? '' : 'none';
        });
    });
</script>

@endsection
