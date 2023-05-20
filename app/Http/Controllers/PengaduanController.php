<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaduanController extends Controller
{

    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi' => 'required',
            'tanggal_kejadian' => 'required',
            'kronologi_kejadian' => 'required',
            'foto_kejadian' => 'image|mimes:jpeg,jpg,png,GIF,gif|max:2048'
        ]);
    }

    public function tablePengaduan()
    {
        $data = [
            'title' => 'Form Pengaduan',
        ];
        return view('main.tablePengaduan', $data);
    }
    public function formPengaduan()
    {
        return view('main.formPengaduan');
    }
}
