<?php

namespace Database\Seeders;

use App\Models\groups;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['name' => 'Admin', 'description' => 'Administrador de la plataforma'],
            ['name' => 'User', 'description' => 'User de la plataforma'],
        ];
        foreach ($datas as $data) {
            groups::create($data);
        }
    }
}
