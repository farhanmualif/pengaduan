<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use PhpParser\Node\Stmt\Return_;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $primaryKey = 'id';
    public $timestamps = true;

    public static function tableUser()
    {
        $data = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->select('users.*', 'groups.name as group_name')
            ->where('groups.name', '=', 'User')
            ->get();
        return $data ?? null;
    }

    public static function tableAdmin()
    {
        $data = DB::table('users')
            ->from('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at', 'groups.name as group_name')
            ->where('groups.name', '=', 'Admin')
            ->get();
        return $data ?? null;
    }

    public static function tableAllUser()
    {
        $data = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->select('users.*', 'groups.name as group_name')
            ->get()[0];
        return $data;
    }
}
