<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Asset extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_aset','nama_aset','kategori','lokasi','deskripsi','estimated_value','image_path','qr_path','room_id', 'kondisi', 'tahun_perolehan'
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'tahun_perolehan' => 'integer',
    ];

    /**
     * Get the room that owns the asset.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the formatted estimated value in Indonesian Rupiah format.
     */
    public function getFormattedEstimatedValueAttribute()
    {
        if (!$this->estimated_value) {
            return '-';
        }
        return 'Rp ' . number_format($this->estimated_value, 0, ',', '.');
    }

    public function getUmurAttribute()
    {
        if (!$this->tahun_perolehan) {
            return 1;
        }
        $diff = (int) date('Y') - (int) $this->tahun_perolehan;
        return $diff > 0 ? $diff : 1;
    }

    public function checks()
    {
        return $this->hasMany(AssetCheck::class);
    }

    public function loans()
    {
        return $this->hasMany(AssetLoan::class);
    }
}