<?php

namespace App\Http\Controllers;

use App\Models\ActivitiesModel;
use App\Models\PengaduanModel;
use App\Models\PengaduanUsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            'status' => false,
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
            ActivitiesModel::addActivity('insert data pengaduan',true);
            return redirect()->route('pengaduan.show',auth()->user()->id)->with('success', 'berhasil menambah laporan');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->with('failed', 'gagal menambah data');
        }
    }

    public function show($id)
    {
        $datas = DB::table('users')->join('pengaduan_users','users.id','=','pengaduan_users.users_id')->join('pengaduan','pengaduan_users.pengaduan_id','=','pengaduan.id')->where('users.id','=', $id)->get();
        return view('main.tablePengaduan', compact('datas'));
    }

    public function create()
    {
        $datas = PengaduanModel::all();
        return view('main.tablePengaduan', compact('datas'));
    }

    public function destroy($id)
    {
        $data = PengaduanModel::find($id);
        if ($data->id == null) {
            return redirect()->back()->with('failed','gagal menemukan data');
        }

        $delete = PengaduanModel::destroy($data->id);

        if (!$delete) {
            return redirect()->back()->with('failed','gagal menghapus data');
        }
        if ($data->foto_kejadian != 'default.png') {
            $delete_image = Storage::delete('public/foto-laporan/'.$data->foto_kejadian);
            if (!$delete_image) {
                return redirect()->back()->with('failed','gagal menghapus gambar');
            }
        }
        ActivitiesModel::addActivity('delete data',true);
        return redirect()->back()->with('success','berhasil menghapus data');

    }

    public function edit($id)
    {
        $pengaduan = PengaduanModel::find($id);

        $datas = [
            'title' => 'Form Update Data Pengaduan',
            'pengaduan' => $pengaduan,
        ];
        return view('main.formUpdatePengaduan',compact('datas'));
    }

    public function update(Request $request, $id)
    {
        $pengaduan = PengaduanModel::findOrfail($id);

        if($request->tanggal_kejadian == null){
            $tanggal_kejadian = $pengaduan->tanggal_kejadian;
        } else {
            $tanggal_kejadian = $request->tanggal_kejadian;
        };

        if($request->kronologi_kejadian == null){
            $kronologi_kejadian = $pengaduan->kronologi_kejadian;
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

        if (!$pengaduan) {
            return redirect()->back()->with('failed', 'gagal mengupdate data');
        }

        // jika user tidak upload gambar
        if (!$request->hasFile('foto_kejadian')) {
            // filename default
            $file_name = 'default.png';
        } else {
            $file = $request->file('foto_kejadian');
            $file_name = $file->hashName();
            $file->store('public/foto-laporan/');
                // delete foto lama
            if ($pengaduan->foto_kejadian != 'default.png') {
                Storage::delete('public/foto-laporan/'. $pengaduan->foto_kejadian);
            }
        }

        $update = $pengaduan->update([
            'judul_pengaduan' => $request->judul_pengaduan,
            'tanggal_kejadian' => $tanggal_kejadian,
            'tempat_kejadian' => $request->tempat_kejadian,
            'kronologi_kejadian' => $kronologi_kejadian,
            'foto_kejadian' => $file_name
        ]);

        if (!$update) {
            return redirect()->back()->with('failed', 'terdapat kesalahan');
        }
        ActivitiesModel::addActivity('mengubah data',true);
        return redirect()->back()->with('success', 'berhasil update data');
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

}
