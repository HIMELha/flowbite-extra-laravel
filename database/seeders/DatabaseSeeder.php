<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        Setting::create([
            'site_name' => 'My Awesome Website',
            'site_title' => 'Welcome to My Awesome Website',
            'site_logo' => 'logo.png',
            'site_description' => 'This is the best website for amazing content.',
            'contact_info' => 'contact@myawesomewebsite.com',
            'facebook_link' => 'https://facebook.com/myawesomewebsite',
            'youtube_link' => 'https://youtube.com/myawesomewebsite',
            'twitter_link' => 'https://twitter.com/myawesomeweb',
            'whatsapp_link' => 'https://wa.me/1234567890',
        ]);
    }
}
