<?php

use App\Models\ActivitiesModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
if (!function_exists('hasRole')) {
    function hasRole()
    {
        $hasRole = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->where('users.id', '=', auth()->user()->id)
            ->select('groups.name')
            ->get()[0];
        return $hasRole->name;
    }
};

if (!function_exists('getRole')) {
    function getRole($id)
    {
        $hasRole = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->where('users.id', '=', $id)
            ->select('groups.name')
            ->get()[0];
        return $hasRole->name;
    }
}


if (!function_exists('getRoles')) {
    function getRoles()
    {
        $getRoles = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->select('groups.name')
            ->get()[0];
        return $getRoles->name;
    }
}

if (!function_exists('getAllUsersAndRoles')) {
    function getAllUsersAndRoles()
    {
        $getAll = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->select('users.*', 'groups.name as group_name')
            ->get()[0];
        return $getAll;
    }
}
if (!function_exists('getUsersWithRole')) {
    function getUsersWithRole($roleName)
    {
        $getAll = DB::table('users')
        ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
        ->join('groups', 'groups.id', '=', 'groups_users.group_id')
        ->select('users.*', 'groups.name as group_name')->where('groups.name','=',$roleName)
        ->get()[0];
    return $getAll;
    }
}
if (!function_exists('getTime')) {
    function getTime()
    {
        date_default_timezone_set('Asia/Jakarta');
        $currentHour = Carbon::now()->hour;

        if ($currentHour >= 0 && $currentHour < 3) {
            return 'Dini Hari';
        } elseif ($currentHour >= 3 && $currentHour < 10) {
            return 'Pagi';
        } elseif ($currentHour >= 10 && $currentHour < 15) {
            return 'Siang';
        } elseif ($currentHour >= 15 && $currentHour < 20) {
            return 'Sore';
        } else {
            return 'Malam';
        }
    }

    if (!function_exists('get_notification')) {
        function get_notification() {
            $data = DB::table('users')->join('pengaduan_users','pengaduan_users.users_id','=','users.id')->join('pengaduan','pengaduan_users.pengaduan_id','=','pengaduan.id')->join('tanggapi_pengaduan','tanggapi_pengaduan.pengaduan_id','=','pengaduan.id')->join('tanggapi','tanggapi.id','=','tanggapi_pengaduan.tanggapi_id')->where('users.id','=',auth()->user()->id);
            // dd($data);
            return $data->get();
        }
    }
    if (!function_exists('count_notification')) {
        function count_notification() {
            $data = DB::table('users')->join('pengaduan_users','pengaduan_users.users_id','=','users.id')->join('pengaduan','pengaduan_users.pengaduan_id','=','pengaduan.id')->join('tanggapi_pengaduan','tanggapi_pengaduan.pengaduan_id','=','pengaduan.id')->join('tanggapi','tanggapi.id','=','tanggapi_pengaduan.tanggapi_id')->where('users.id','=',auth()->user()->id)->count();
            // dd($data);
            return $data;
        }
    }
}
