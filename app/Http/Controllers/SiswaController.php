<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        $categories = Category::all();

        return view('siswa.dashboard', compact('books', 'categories'));
    }

    public function pinjam()
    {
        $books = Book::with('category')->get();
        $categories = Category::all();

        return view('siswa.pinjam', compact('books', 'categories'));
    }

    public function storePinjam(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'book_id' => 'required',
        ]);

        $JumlahPinjam = Peminjaman::where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->count();
            if ($JumlahPinjam >=3){
                return back()->with('error', 'Gagal meminjam: Anda sudah mememinjam batas maksimal (3 buku). Silakan kembalikan terlebih dahulu!');
            }

        $book = Book::findOrFail($request->book_id);
        if ($book->stok < 1) {
            return back()->with('error', 'Gagal meminjam: Stok buku habis!');
        }

        $book->decrement('stok');

        Peminjaman::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'tanggal_pinjam' => \Carbon\Carbon::now()->format('Y-m-d'),
            'tanggal_kembali' => \Carbon\Carbon::now()->addDays(7)->format('Y-m-d'),
            'status' => 'dipinjam',
        ]);

        return redirect()->route('siswa.riwayat')->with('success', 'Pengajuan peminjaman berhasil! Silakan ambil ambil buku di perpustakaan.');
    }

    public function kembali()
    {
        $peminjaman = Peminjaman::with('book')
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->get();

        return view('siswa.kembali', compact('peminjaman'));
    }

    public function riwayat()
    {
        $riwayat = Peminjaman::with('book')
            ->where('user_id', Auth::id())
            ->get();

        return view('siswa.riwayat', compact('riwayat'));
    }

    public function storeKembali($id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $peminjaman->update([
            'status' => 'dikembalikan'
        ]);

        if ($peminjaman->book_id) {
            Book::where('id', $peminjaman->book_id)->increment('stok');
        }

        return back()->with('success', 'Buku berhasil dikembalikan!');
    }
}
