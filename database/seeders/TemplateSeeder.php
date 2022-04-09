<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = DB::table('templates');
        $template->truncate();
        $data = [
            [
                'name' => 'content_name',
                'html' => 'html'
            ],
            [
                'name' => 'content_1',
                'html' => 'html12'
            ],
            [
                'name' => 'content_test',
                'html' => 'html123'
            ],
        ];
        $template->insert($data);
    }
}
