<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::create([
            'name'=>'daraz',
            'logo'=>'logo.png',
            'icon'=>'icon.png',
            'fav_icon'=>'favicon.png',
            'number1'=>'01890123321',
            'number2'=>'01990111222',
            'email1'=>'s@gmail.com',
            'email2'=>'example@gmail.com',
            'address'=>'Dhaka,Bangladesh',
            'facebook'=>'https://web.facebook.com/',
            'youtube'=>'https://www.youtube.com/',
            'instagram'=>'https://www.instagram.com/',
            'twitter'=>'https://twitter.com/',
        ]);
    }
}
