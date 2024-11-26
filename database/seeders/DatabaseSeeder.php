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

        $realSettings = [
            [
                'key' => 'site_title',
                'type' => 'general_setting',
                'values' => json_encode(['value' => 'My Marketplace']),
                'description' => 'The title of the website displayed in the header.',
                'status' => 'active',
            ],
            [
                'key' => 'currency',
                'type' => 'general_setting',
                'values' => json_encode(['code' => 'USD', 'symbol' => '$']),
                'description' => 'Default currency for transactions.',
                'status' => 'active',
            ],
            [
                'key' => 'bkasj',
                'type' => 'payment_setting',
                'values' => json_encode(['methods' => ['paypal', 'stripe']]),
                'description' => 'Available payment methods.',
                'status' => 'active',
            ],
        ];

        foreach ($realSettings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
