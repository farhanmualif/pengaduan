<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanUsersModel extends Model
{
    use HasFactory;
    protected $table = 'pengaduan_users';
    protected $fillable = [
        'pengaduan_id',
        'users_id'
    ];

    public $timestamps = false;
}
