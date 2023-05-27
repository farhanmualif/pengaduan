<?php

namespace Database\Seeders;

use App\Models\PengaduanModel;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PengaduanSeeder extends Seeder
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
                'judul_pengaduan' => 'jalan rusak',
                'tempat_kejadian' => 'Yogyakarta',
                'kronologi_kejadian' => 'jalan ruksa kronologi',
                'tanggal_kejadian' => Carbon::now(),
                'foto_kejadian' => 'default.png'
            ],
            [
                'judul_pengaduan' => 'Pembunuhan',
                'tempat_kejadian' => 'Yogyakarta',
                'kronologi_kejadian' => 'Pembunuhan kronologi',
                'tanggal_kejadian' => Carbon::now(),
                'foto_kejadian' => 'default.png'
            ],
        ];
        foreach ($datas as $data) {
            PengaduanModel::create($data);
        }
    }
}
