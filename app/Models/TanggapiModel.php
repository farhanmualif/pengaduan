<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TanggapiModel extends Model
{
    use HasFactory;
    protected $table = 'tanggapi';
    protected $fillable = [
        'isi_tanggapi',
        'ditanggapi_oleh'
    ];
    public $timestamps = true;
}
