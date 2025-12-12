<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelulusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'nis',
        'jurusan_id',
        'status_kelulusan',
        'status_pembayaran',
        'file_pdf',
        'tahun_lulus',
        'keterangan',
    ];

    protected $casts = [
        'tahun_lulus' => 'integer',
    ];

    /**
     * Relasi ke tabel jurusans
     */
    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    /**
     * Check apakah siswa lulus dan sudah bayar
     */
    public function isLulusLunas(): bool
    {
        return $this->status_kelulusan === 'lulus'
            && $this->status_pembayaran === 'lunas';
    }

    /**
     * Check apakah siswa lulus tapi belum bayar
     */
    public function isLulusBelumBayar(): bool
    {
        return $this->status_kelulusan === 'lulus'
            && $this->status_pembayaran === 'belum_lunas';
    }

    /**
     * Check apakah siswa tidak lulus
     */
    public function isTidakLulus(): bool
    {
        return $this->status_kelulusan === 'tidak_lulus';
    }
}
