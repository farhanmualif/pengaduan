<?php

namespace App\Http\Controllers;

use App\Models\ActivitiesModel;
use App\Models\PengaduanModel;
use App\Models\TanggapiModel;
use App\Models\TanggapiPengaduanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TanggapiController extends Controller
{
    // menanggapi pengaduan oleh pegawai / admin
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'isi_tanggapi' => 'required'
        ],
        [
            'isi_tanggapi.required' => 'tanggap tidak boleh kosong'
        ]);

        $data = [
            'isi_tanggapi' => $request->isi_tanggapi,
            'ditanggapi_oleh' => auth()->user()->name,
            'created_at' => Carbon::now()
        ];
        // menambahkan ke table tanggapi
        $insert_tanggapi = TanggapiModel::create($data);
        if (!$insert_tanggapi) {
            return redirect()->back()->with('failed', 'gagal menambahkan data tanggapi pengaduan');
        }
        // menambahkan ke table relasi tanggapi->pengaduan
        $insert_tanggapi_pengaduan = TanggapiPengaduanModel::create([
            'tanggapi_id' => $insert_tanggapi->id,
            'pengaduan_id' => $request->pengaduan_id,
        ]);

        if (!$insert_tanggapi_pengaduan) {
            return redirect()->back()->with('failed', 'gagal menambahkan data tanggapi pengaduan');
        }
        // melakukan update pada status pengaduan menjadi true
        $update_pengaduan_status = PengaduanModel::where('id', $request->pengaduan_id)
            ->update([
                'status' => true,
                'updated_at' => Carbon::now()
            ]);

        if (!$update_pengaduan_status) {
            return redirect()->back()->with('failed', 'gagal update status pengaduan');
        }
        ActivitiesModel::addActivity('menanggapi laporan');
        return redirect()->to('pengaduan/create')->with('success', 'berhasil menambahkan data tanggapi');
    }

    public function tablePengaduanDitanggapi($id)
    {
        $datas = DB::table('users')
            ->join('pengaduan_users', 'pengaduan_users.users_id', '=', 'users.id')
            ->join('pengaduan', 'pengaduan_users.pengaduan_id', '=', 'pengaduan.id')
            ->join('tanggapi_pengaduan','tanggapi_pengaduan.pengaduan_id','=','pengaduan.id')
            ->join('tanggapi','tanggapi.id','=','tanggapi_pengaduan.tanggapi_id')
            ->where('users.id', $id)
            ->where('pengaduan.status', 1)
            ->select('*')
            ->get();
        // dd($datas);
        return view('main.tablePengaduanDitanggapi', compact('datas'));
    }

    public function formTanggapiPengaduan($id)
    {
        $datas = [
            'title' => 'Tanggapi Pengaduan',
            'pengaduan' => PengaduanModel::find($id)
        ];
        return view('main.formTanggapiPengaduan', compact('datas'));
    }
}
