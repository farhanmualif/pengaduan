<?php

namespace App\Http\Controllers;

use App\Models\PengaduanModel;
use App\Models\PengaduanUsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Backtrace\File;

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
        $file = $request->file('file');
        if (!$file) {
            $file_name = 'default.png';
        } else {
            $file_name = $file->hashName();
            $file->storeAs('public/foto-laporan', $file_name);
        }

        $data = [
            'judul_pengaduan' => $request->judul_pengaduan,
            'tempat_kejadian' => $request->tempat_kejadian,
            'kronologi_kejadian' => $request->kronologi_kejadian,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'foto_kejadian' => $file_name,
        ];

        DB::beginTransaction();
        try {
            $insert = PengaduanModel::create($data);
            $data_pengaduan_user = [
                'users_id' => auth()->user()->id,
                'pengaduan_id' => $insert->id,
            ];
            PengaduanUsersModel::create($data_pengaduan_user);
            DB::commit();
            return redirect()->route('pengaduan.create')->with('success', 'berhasil menambah laporan');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->with('failed', 'gagal menambah data');
        }
    }

    public function create()
    {
        $datas = PengaduanModel::all();
        return view('main.tablePengaduan', compact('datas'));
    }

    public function destroy($id)
    {
        $data = PengaduanModel::find($id);
        if($data->id != null){
            PengaduanModel::destroy($data->id);
            return redirect()->back()->with('success','berhasil menghapus data');
        } else{
            return redirect()->back()->with('error','Data tidak ditemukan');
        };
    }

    public function edit(Request $request, $id)
    {
        $data = PengaduanModel::find($id);
        if($request->tanggal_kejadian == null){
            $tanggal_kejadian = $data->tanggal_kejadian;
        } else {
            $tanggal_kejadian = $request->tanggal_kejadian;
        };

        if($request->kronologi_kejadian == null){
            $kronologi_kejadian = $data->kronologi_kejadian;
        } else {
            $kronologi_kejadian = $request->kronologi_kejadian;
        };

        $this->validate(
            $request,
            [
                'judul_pengaduan' => 'required',
                'tempat_kejadian' => 'required',
            ],
            [
                'judul_pengaduan.required' => 'Judul Pengaduan wajib diisi',
                'tempat_kejadian_kejadian.required' => 'Tempat Kejadian wajib diisi',
            ]
        );

        $pengaduan = PengaduanModel::findOrfail($id);
        if (!$pengaduan) {
            return redirect()->back()->with('failed', 'gagal mengupdate data');
        }
        try {
            $pengaduan->update([
                'judul_pengaduan' => $request->judul_pengaduan,
                'tanggal_kejadian' => $tanggal_kejadian,
                'tempat_kejadian' => $request->tempat_kejadian,
                'kronologi_kejadian' => $kronologi_kejadian,
            ]);
            return redirect()->back()->with('success', 'berhasil update data');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'terdapat kesalahan'.$th);
        }

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
        $datas = [
            'title'=>'Form Pengaduan'
        ];
        return view('main.formPengaduan',compact('datas'));
    }
    public function formUpdatePengaduan($id)
    {

        $pengaduan = PengaduanModel::find($id);

        $datas = [
            'title' => 'Form Update Data Pengaduan',
            'pengaduan' => $pengaduan,
        ];
        return view('main.formUpdatePengaduan',compact('datas'));
    }
}
