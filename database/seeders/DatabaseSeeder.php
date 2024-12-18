<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $permissions = [
            'manage_users',
            'manage_categories',
            'manage_auth',
            'manage_roles',
            'manage_pages',
            'manage_settings'
        ];

        foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
        }

        $roles = [
            'superadmin',
            'admin',
            'customersupport',
            'staff',
            'manager',
            'financemanager',
            'moderator'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $superAdmin = User::create([
            "uid" => "234343",
            "name" => "superadmin",
            "email" => "superadmin@mail.com",
            "password" => Hash::make("12345678"),
            "profile" => "images/user.png"
        ]);

        $superAdminRole = Role::findByName('superadmin');
        $superAdminRole->syncPermissions($permissions);
        $superAdmin->assignRole($superAdminRole);

        $admin = User::create([
            "uid" => "545353",
            "name" => "admin",
            "email" => "admin@mail.com",
            "password" => Hash::make("12345678"),
            "profile" => "images/user.png"
        ]);

        $adminRole = Role::findByName('admin');
        $adminRole->syncPermissions($permissions);
        $admin->assignRole($superAdminRole);

        Setting::create([
            'site_name' => 'Flowbite',
            'site_title' => 'Welcome to Flowbite Extra Laravel',
            'site_logo' => 'uploads/settings/1733384892_67515abce08cf.png',
            'site_description' => 'This is the best website for amazing content.',
            'contact_info' => 'contact@myawesomewebsite.com',
            'facebook_link' => 'https://facebook.com/myawesomewebsite',
            'youtube_link' => 'https://youtube.com/myawesomewebsite',
            'twitter_link' => 'https://twitter.com/myawesomeweb',
            'whatsapp_link' => 'https://wa.me/1234567890',
        ]);
    }
}
