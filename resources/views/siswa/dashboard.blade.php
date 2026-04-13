@extends('layouts.app')

@section('content')
<div class="py-8 px-4 max-w-7xl mx-auto">

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


        <div class="bg-white rounded-xl shadow-sm border-2 border-[#1e3a8a] flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-blue-500 p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Cari Buku</span>
        </div>


        <a href="{{ route('siswa.riwayat') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 flex flex-col items-center justify-center py-8 hover:shadow-md transition">
            <div class="bg-[#a855f7] p-4 rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <span class="font-semibold text-gray-700">Riwayat</span>
        </a>
    </div>


    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

        <!-- Header -->
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <h2 class="text-xl font-bold text-gray-800">Cari Buku</h2>
        </div>

        <!-- Search Bar -->
        <div class="relative mb-6">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" id="searchInput" class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm shadow-sm" placeholder="Cari buku berdasarkan judul, penulis, atau kategori...">
        </div>

        <!-- Filters -->
        <div class="flex flex-wrap gap-3 mb-8">
            <button data-category="semua" class="category-btn px-5 py-2 bg-[#1e3a8a] text-white text-sm font-medium rounded-full cursor-pointer hover:bg-blue-900 transition">Semua Kategori</button>
            @forelse($categories as $category)
                <button data-category="{{ $category->category_name }}" class="category-btn px-5 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-full cursor-pointer hover:bg-gray-200 transition">{{ $category->category_name }}</button>
            @empty
                <button data-category="sains" class="category-btn px-5 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-full cursor-pointer hover:bg-gray-200 transition">Sains</button>
                <button data-category="teknologi" class="category-btn px-5 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-full cursor-pointer hover:bg-gray-200 transition">Teknologi</button>
                <button data-category="fiksi" class="category-btn px-5 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-full cursor-pointer hover:bg-gray-200 transition">Fiksi</button>
                <button data-category="sejarah" class="category-btn px-5 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-full cursor-pointer hover:bg-gray-200 transition">Sejarah</button>
                <button data-category="pelajaran" class="category-btn px-5 py-2 bg-gray-100 text-gray-600 text-sm font-medium rounded-full cursor-pointer hover:bg-gray-200 transition">Pelajaran</button>
            @endforelse
        </div>

        <p class="text-sm text-gray-400 font-medium mb-6" id="countText">Menampilkan {{ count($books) }} buku terdaftar</p>

        <!-- Book Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="bookGrid">
            @foreach($books as $book)
            <div class="book-item border border-gray-200 rounded-xl p-5 hover:shadow-md transition bg-white flex flex-col h-full"
                 data-title="{{ strtolower($book->judul) }}"
                 data-author="{{ strtolower($book->penulis) }}"
                 data-category="{{ strtolower($book->category->category_name ?? '') }}">
                <!-- Card Header -->
                <div class="flex justify-between items-start mb-4">
                    <div class="bg-blue-50 p-3 rounded-xl text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <span class="bg-[#10b981] text-white text-xs font-bold px-3 py-1 rounded-full">
                        Tersedia ({{ $book->stok }})
                    </span>
                </div>

                <!-- Book Info -->
                <h3 class="font-bold text-lg text-gray-800 mb-2 leading-tight">{{ $book->judul }}</h3>

                <div class="flex items-center text-gray-400 text-sm mb-1">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ $book->penulis }}
                </div>

                <div class="flex items-center text-gray-400 text-sm mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ $book->tahun_terbit }}
                </div>

                <div class="mt-auto">
                    <hr class="border-gray-100 mb-4">
                    <div class="flex justify-between items-center text-xs">
                        <div class="flex flex-col">
                            <span class="text-gray-400 mb-1">ISBN</span>
                            <span class="text-gray-400">Kategori</span>
                        </div>
                        <div class="flex flex-col text-right">
                            <span class="text-gray-800 font-medium mb-1">{{ $book->ISBN }}</span>
                            <span class="text-gray-800 font-medium">{{ $book->category->category_name ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryBtns = document.querySelectorAll('.category-btn');
    const bookItems = document.querySelectorAll('.book-item');
    const countText = document.getElementById('countText');

    let currentCategory = 'semua';
    let searchQuery = '';

    function filterBooks() {
        let visibleCount = 0;

        bookItems.forEach(item => {
            const title = item.getAttribute('data-title');
            const author = item.getAttribute('data-author');
            const itemCategory = item.getAttribute('data-category');

            const matchesSearch = title.includes(searchQuery) || author.includes(searchQuery) || itemCategory.includes(searchQuery);
            const matchesCategory = currentCategory === 'semua' || itemCategory === currentCategory;

            if (matchesSearch && matchesCategory) {
                item.style.display = 'flex';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        countText.textContent = `Menampilkan ${visibleCount} buku terdaftar`;
    }

    searchInput.addEventListener('input', function(e) {
        searchQuery = e.target.value.toLowerCase();
        filterBooks();
    });

    categoryBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Reset state of all buttons
            categoryBtns.forEach(b => {
                b.classList.remove('bg-[#1e3a8a]', 'text-white', 'hover:bg-blue-900');
                b.classList.add('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
            });

            // Set active state
            this.classList.remove('bg-gray-100', 'text-gray-600', 'hover:bg-gray-200');
            this.classList.add('bg-[#1e3a8a]', 'text-white', 'hover:bg-blue-900');

            const catAttr = this.getAttribute('data-category');
            currentCategory = catAttr === 'semua' ? 'semua' : catAttr.toLowerCase();
            
            filterBooks();
        });
    });
});
</script>
@endsection
