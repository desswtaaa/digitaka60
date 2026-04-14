<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalBuku = Book::sum('stok');
        $judulBerbeda = Book::count();
        $anggotaAktif = User::where('role', 'siswa')->count();
        $sedangDipinjam = Peminjaman::where('status', 'dipinjam')->count();
        $terlambat = Peminjaman::where('status', 'dipinjam')
                        ->whereDate('tanggal_kembali', '<', \Carbon\Carbon::today())
                        ->count();

        $transaksiTerbaru = Peminjaman::with(['book', 'user'])
                                ->latest()
                                ->take(4)
                                ->get();

        $bukuPopuler = Book::with('category')
                            ->orderBy('stok', 'desc')
                            ->take(4)
                            ->get();

        return view('admin.dashboard', compact(
            'totalBuku', 'judulBerbeda', 'anggotaAktif',
            'sedangDipinjam', 'terlambat', 'transaksiTerbaru', 'bukuPopuler'
        ));
    }

    public function books()
    {
        $books = Book::with('category')->get();
        $categories = Category::all();
        return view('admin.books', compact('books', 'categories'));
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'nullable',
            'ISBN' => 'nullable',
            'category_id' => 'required',
            'stok' => 'required|numeric',
            'tahun_terbit' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['penerbit'] = $data['penerbit'] ?? '-';
        $data['ISBN'] = $data['ISBN'] ?? '-';

        Book::create($data);

        return redirect()->route('admin.books')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function updateBook(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'nullable',
            'ISBN' => 'nullable',
            'category_id' => 'required',
            'stok' => 'required|numeric',
            'tahun_terbit' => 'required|numeric',
        ]);

        $book = Book::findOrFail($id);

        $data = $request->all();
        $data['penerbit'] = $data['penerbit'] ?? '-';
        $data['ISBN'] = $data['ISBN'] ?? '-';

        $book->update($data);

        return redirect()->route('admin.books')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroyBook($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Buku berhasil dihapus!');
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->books()->count() > 0) {
            return redirect()->route('admin.categories')->with('error', 'Tidak dapat menghapus kategori karena masih ada buku yang ditautkan ke kategori ini.');
        }

        $category->delete();

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil dihapus!');
    }

    public function anggota()
    {
        $anggota = User::where('role', 'siswa')->get();
        return view('admin.anggota', compact('anggota'));
    }

    public function storeAnggota(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'nisn' => 'nullable',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $data['role'] = 'siswa';

        User::create($data);

        return redirect()->route('admin.anggota')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function updateAnggota(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'nisn' => 'nullable',
        ]);

        $user = User::findOrFail($id);
        $data = $request->all();

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.anggota')->with('success', 'Anggota berhasil diperbarui!');
    }

    public function destroyAnggota($id)
    {
        $user = User::findOrFail($id);

        if ($user->borrows()->count() > 0) {
            return redirect()->route('admin.anggota')->with('error', 'Tidak dapat menghapus anggota karena masih memiliki riwayat peminjaman buku.');
        }

        $user->delete();

        return redirect()->route('admin.anggota')->with('success', 'Anggota berhasil dihapus!');
    }

    public function peminjaman()
    {
        $peminjaman = Peminjaman::with('book', 'user')->get();
        $books = Book::all();
        $users = User::where('role', 'siswa')->get();
        return view('admin.peminjaman', compact('peminjaman', 'books', 'users'));
    }

    public function storePeminjaman(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $book = Book::findOrFail($request->book_id);
        if ($book->stok < 1) {
            return back()->with('error', 'Gagal meminjam: Stok buku habis!');
        }

        $data = $request->all();
        $data['status'] = $data['status'] ?? 'dipinjam';

        $book->decrement('stok');
        Peminjaman::create($data);

        return redirect()->route('admin.peminjaman')->with('success', 'Transaksi peminjaman berhasil ditambahkan!');
    }

    public function updatePeminjaman(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,dikembalikan',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $oldStatus = $peminjaman->status;

        $peminjaman->update($request->all());

        if ($oldStatus == 'dipinjam' && $request->status == 'dikembalikan') {
            Book::where('id', $peminjaman->book_id)->increment('stok');
        } elseif ($oldStatus == 'dikembalikan' && $request->status == 'dipinjam') {
            Book::where('id', $peminjaman->book_id)->decrement('stok');
        }

        return redirect()->route('admin.peminjaman')->with('success', 'Transaksi peminjaman berhasil diperbarui!');
    }

    public function destroyPeminjaman($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        if ($peminjaman->status == 'dipinjam') {
            Book::where('id', $peminjaman->book_id)->increment('stok');
        }
        $peminjaman->delete();

        return redirect()->route('admin.peminjaman')->with('success', 'Transaksi peminjaman berhasil dihapus!');
    }


}
