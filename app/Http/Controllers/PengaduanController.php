<?php

namespace App\Http\Controllers;

use App\Models\PengaduanModel;
use App\Models\PengaduanUsersModel;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{

    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'judul_pengaduan' => 'required',
                'tanggal_kejadian' => 'required',
                'tempat_kejadian' => 'required',
                'kronologi_kejadian' => 'required',
                'foto_kejadian' => 'image|mimes:jpeg,jpg,png,GIF,gif|max:2048'
            ],
            [
                'judul_pengaduan.required' => 'Judul Pengaduan wajib diisi',
                'tanggal_kejadian.required' => 'Tanggal Kejadian wajib diisi',
                'tempat_kejadian_kejadian.required' => 'Tempat Kejadian wajib diisi',
                'kronologi_kejadian.required' => 'Kronologi Kejadian wajib diisi',
                'foto_kejadian.image' => 'Foto Kejadian harus berformat gambar',
            ]
        );
        // getfile
        $file = $request->file('foto_kejadian');

        if ($file != null) {
            $file_name = $file->hashName();
            $file->storeAs('public/foto-laporan', $file_name);
        } else {
            $file_name = 'default.png';
        }

        $data = [
            'judul_pengaduan' => $request->judul_pengaduan,
            'tempat_kejadian' => $request->tempat_kejadian,
            'kronologi_kejadian' => $request->kronologi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'foto_kejadian' => $file_name,
        ];
        $insert = PengaduanModel::create($data);

        $data_pengaduan_user = [
            'users_id' => auth()->user()->id,
            'pengaduan_id' => $insert->id
        ];

        $insert_to_pengaduan_user = PengaduanUsersModel::create($data_pengaduan_user);

        if ($insert && $insert_to_pengaduan_user) {
            return redirect()->route('pengaduan.create')->with('success', 'berhasil menambah laporan');
        } else {
            return redirect()->back()->with('failed', 'gagal menambah data');
        }
    }

    public function create()
    {
        $datas = PengaduanModel::all();
        return view('main.tablePengaduan', compact('datas'));
    }

    public function formEdit()
    {
        # code...
    }

    public function destroy($id)
    {
        # code...
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
