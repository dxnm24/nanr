<?php

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Config::create([
            'code' => '',
            'meta_title' => '',
            'meta_keyword' => '',
            'meta_description' => '',
            'meta_image' => '',
            'facebook_app_id' => '',
            'status' => ACTIVE,
            'lang' => VI,
        ]);
    }
}
