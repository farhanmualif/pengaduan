<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $userType)
    {
        $hasRole = DB::table('users')
            ->join('groups_users', 'groups_users.user_id', '=', 'users.id')
            ->join('groups', 'groups.id', '=', 'groups_users.group_id')
            ->where('users.id', '=', auth()->user()->id)
            ->select('groups.name')
            ->get()[0];

        if ($hasRole->name == $userType) {
            return $next($request);
        }
        return response()->json(['You do not have permission to access for this page., your permission is ']);
    }
}
