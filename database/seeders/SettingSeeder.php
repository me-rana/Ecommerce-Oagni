<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (DB::table('settings')->count() == 0){
            DB::table('settings')->insert([
                'name' => 'Ogani Ecommerce (Sample)',
                'logo_path' => 'assets/img/logo.png',
                'phone_no' => '+8801521380065',
                'email' => 'contact@ranasvc.com',
                'facebook' => 'https://www.facebook.com/ranab.me',
                'linkdin' => 'https://www.linkedin.com/in/rana-bepari/',
                'twitter' => '#',
                'pinterest' => '#',
                'office_time' => '10:00 AM to 8:00 PM',
                'address' => 'Dhaka-1216, Bangladesh',
                'copyright' => 'https://ranasvc.com/storage/image/49411Rana%20Bepari%20--CopyrightB-01.png',

            ]);
        }
    }
}
