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
        groups_users::create([
            'group_id' => 1,
            'users_id' => 1
        ]);
    }
}
