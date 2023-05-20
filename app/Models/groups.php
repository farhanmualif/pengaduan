<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class groups extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'id',
        'name',
        'description',
    ];
    public $timestamps = false;

    public static function getRoleFromUserId($id)
    {
        $data = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->select('groups.*')
            ->where('users.id', '=', $id)
            ->get();
        return $data[0] ?? null;
    }
}
