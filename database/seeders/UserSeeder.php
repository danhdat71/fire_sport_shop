<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Constants\RoleConstants;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #SUPER ADMIN
        User::create([
            'email' => 'danhdat71@gmail.com',
            'name' => 'Danh Đạt',
            'role' => RoleConstants::SUPER_ADMIN
        ]);

        #ADMIN
        User::create([
            'email' => 'datd@bap.jp',
            'name' => 'Danh Đạt',
            'role' => RoleConstants::ADMIN
        ]);
    }
}
