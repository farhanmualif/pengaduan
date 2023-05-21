<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'name' => 'user',
                'email' => 'user@mail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('123456'),
            ]
        ];
        foreach ($datas as $data) {
            User::create($data);
        }
    }
}
