<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'user_id',
        'peminjam',
        'tanggal_pinjam',
        'tenggat_kembali',
        'tanggal_dikembalikan',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tenggat_kembali' => 'date',
        'tanggal_dikembalikan' => 'date',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
