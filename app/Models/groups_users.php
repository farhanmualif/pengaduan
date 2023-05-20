<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class groups_users extends Model
{
    use HasFactory;
    protected $table = 'groups_users';
    protected $fillable = [
        'group_id', 'user_id'
    ];

    public $timestamps = false;
}
