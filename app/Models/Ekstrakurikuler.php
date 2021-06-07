<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakurikuler';

    public function ketua()
    {
        return $this->belongsTo(User::class, 'nis_ketua', 'username');
    }

    public function pendaftar()
    {
        return $this->hasMany(Formulir::class, 'id_ekstrakurikuler');
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class, 'id_ekstrakurikuler');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'id_ekstrakurikuler')->orderBy('tgl_mulai')->orderBy('jam_mulai');
    }
}
