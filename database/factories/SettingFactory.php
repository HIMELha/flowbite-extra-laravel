<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $settings = [
            [
                'key' => 'site_title',
                'type' => 'general_setting',
                'values' => json_encode(['value' => 'My Marketplace']),
                'description' => 'The title of the website displayed in the header.',
                'status' => 'active',
            ],
            [
                'key' => 'site_logo',
                'type' => 'general_setting',
                'values' => json_encode(['url' => '/images/logo.png']),
                'description' => 'The logo of the website.',
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
                'key' => 'payment_methods',
                'type' => 'payment_setting',
                'values' => json_encode(['methods' => ['paypal', 'stripe', 'bank_transfer']]),
                'description' => 'Available payment methods.',
                'status' => 'active',
            ],
            [
                'key' => 'smtp_settings',
                'type' => 'notification_setting',
                'values' => json_encode([
                    'host' => 'smtp.mailtrap.io',
                    'port' => 587,
                    'username' => 'user@mailtrap.io',
                    'password' => 'password123',
                ]),
                'description' => 'SMTP settings for email notifications.',
                'status' => 'active',
            ],
        ];

        return $this->faker->randomElement($settings);
    }
}
