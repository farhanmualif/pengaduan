<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'judul_kejadian',
        'tanggal_kejadian',
        'kronologi_kejadian',
        'foto_kejadian'
    ];

    protected $timestamps = true;
    public $primaryKey = 'id';
}
