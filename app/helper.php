<?php

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
