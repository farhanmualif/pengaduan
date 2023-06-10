<?php

namespace App\Http\Controllers;

use App\Models\ActivitiesModel;
use App\Models\groups;
use App\Models\groups_users;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('main.main');
    }

    public function profile($id)
    {
        $activities = ActivitiesModel::find($id);
        $ago = ActivitiesModel::find($id);
        $time = Carbon::parse($ago->created_at);

        return view('main.profile', compact('activities', 'time'));
    }
    public function show($role)
    {
        $datas = [
            'datas' => getUsersWithRole($role),
        ];
        return view('main.tableUser', compact('datas'));
    }

    public function formUpdateUser($id)
    {
        $data = User::tableAllUser();
        $group = groups::getRoleFromUserId($id);
        $groups = groups::all();
        return view('main.formUpdateUser', compact('data', 'groups', 'group'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        $check = User::findOrFail($id);
        if (!$check) {
            return redirect()->back()->with('failed', 'data yang akan di update tidak ada');
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $updated = groups_users::where('user_id', $id)->update(['group_id' => $request->role]);

        if (!$updated) {
            return redirect()->back()->with('failed', 'gagal mengupdate data');
        }
        return redirect()->route('logout')->with('success', 'silahkan login kembali');
    }
}
