<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Size;
use Carbon\Carbon;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        #Create sizes
        $sizes = [
            ['name' => 'S', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'M', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'L', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'XL', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'XXL', 'created_at' => $now, 'updated_at' => $now],
        ];
        Size::insert($sizes);
    }
}
