<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanModel extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';
    protected $fillable = [
        'id',
        'judul_pengaduan',
        'tempat_kejadian',
        'tanggal_kejadian',
        'kronologi_kejadian',
        'foto_kejadian',
        'status',
    ];

    public $timestamps = true;
    public $primaryKey = 'id';
}
