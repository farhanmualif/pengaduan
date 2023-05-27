<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapiPengaduanModel extends Model
{
    use HasFactory;
    protected $table = 'tanggapi_pengaduan';
    protected $fillable = [
        'pengaduan_id',
        'tanggapi_id'
    ];

    public $timestamps = false;
}
