<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Peminjaman;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'ISBN',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
