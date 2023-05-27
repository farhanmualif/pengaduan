<?php

namespace Database\Seeders;

use App\Models\TanggapiModel;
use App\Models\TanggapiPengaduanModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanggapiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'isi_tanggapi' => 'akan kami pantau',
                'ditanggapi_oleh' => 'lukman',
                'created_at' => Carbon::now(),
            ],
            [
                'isi_tanggapi' => 'akan kami pantau',
                'ditanggapi_oleh' => 'lukman',
                'created_at' => Carbon::now(),
            ],
        ];
        foreach ($datas as $data) {
            TanggapiModel::create($data);
        }
    }
}
