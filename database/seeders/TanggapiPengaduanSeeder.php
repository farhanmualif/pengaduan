<?php

namespace Database\Seeders;

use App\Models\TanggapiPengaduanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanggapiPengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['pengaduan_id' => 1, 'tanggapi_id' => 1],
            ['pengaduan_id' => 2, 'tanggapi_id' => 2]
        ];

        foreach ($datas as $data) {
            TanggapiPengaduanModel::create($data);
        }
    }
}
