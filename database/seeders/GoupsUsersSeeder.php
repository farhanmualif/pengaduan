<?php

namespace Database\Seeders;

use App\Models\groups_users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoupsUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $datas = [
            ['group_id' => 1, 'user_id' => 1],
            ['group_id' => 2, 'user_id' => 2]
        ];

        foreach ($datas as $data) {
            groups_users::create($data);
        }
    }
}
