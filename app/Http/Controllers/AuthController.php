<?php

namespace App\Http\Controllers;

use App\Models\groups;
use App\Models\groups_users;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email tidak bleh kosong',
                'password.required' => 'password tidak bleh kosong',
            ]
        );

        $datauser = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::attempt($datauser)) {
            $request->session()->regenerate();
            return redirect()->to('/home');
        } else {
            return redirect()->back()->with('failed', 'gagal melakukan login');
        }
    }

    public function formRegister()
    {
        return view('auth.register');
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|min:6',
                'email' => 'required|min:6',
                'password' => 'required|min:6',
            ],
            [
                'name.required' => 'nama tidak boleh kosong',
                'email.required' => 'email tidak boleh kosong',
                'password.required' => 'password tidak boleh kosong',
            ]
        );

        $data_users = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $insert = User::create($data_users);
        $groups_data = [
            'user_id' => $insert->id,
            'group_id' => 1
        ];

        $groups_insert = groups_users::create($groups_data);

        if ($groups_insert) {
            return redirect()->to('/login')->with('success', 'berhasil register');
        } else {
            return redirect()->back()->with('failed', 'gagal melakukan register');
        };
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->to('/');
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
