<?php

namespace Database\Seeders;

use App\Models\PengaduanUsersModel;
use Illuminate\Database\Seeder;

class PengaduanUser extends Seeder
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
                'users_id' => 2,
                'pengaduan_id' => 1,
            ],
            [
                'users_id' => 2,
                'pengaduan_id' => 2,
            ]
        ];

        foreach ($datas as $data) {
            PengaduanUsersModel::create($data);
        }
    }
}
