<?php

namespace Database\Seeders;

use App\Models\Settings\Settings;
use Illuminate\Database\Seeder;

class SettingsTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'default.timezone',
                'value' => 'Europe/London',
                'description' => 'Default timezone for users',
                'type' => 'relation',
                'type_reference' => 'App\Models\Countries\CountriesZones',
                'locked' => 0
            ],
            [
                'key' => 'default.country',
                'value' => 'United Kingdom',
                'description' => 'Default country for users',
                'type' => 'relation',
                'type_reference' => 'App\Models\Countries\Countries',
                'locked' => 0
            ],
            [
                'key' => 'default.language',
                'value' => 'en-GB',
                'description' => 'Default language for users',
                'type' => 'relation',
                'type_reference' => 'App\Models\Countries\CountriesLanguages',
                'locked' => 0
            ],
            [
                'key' => 'default.logo',
                'value' => 'images/default_logo.svg',
                'description' => 'Default logo',
                'type' => 'image',
                'locked' => 0
            ],
            [
                'key' => 'default.user_role',
                'value' => '2',
                'description' => 'Default user role',
                'type' => 'relation',
                'type_reference' => 'App\Models\Users\UsersRolesMap',
                'locked' => 0
            ],
            [
                'key' => 'default.public_user_role',
                'value' => '1',
                'description' => 'Public user role',
                'type' => 'relation',
                'type_reference' => 'App\Models\Users\UsersRolesMap',
                'locked' => 0
            ],
            [
                'key' => 'default.user_register_allowed',
                'value' => '1',
                'description' => 'Allow registering users public',
                'type' => 'boolean',
                'locked' => 0
            ],
            [
                'key' => 'design.footer_container_fluid',
                'value' => '1',
                'description' => 'Switch from fluid / none-fluid container',
                'type' => 'boolean',
                'locked' => 0
            ],
            [
                'key' => 'design.top_container_fluid',
                'value' => '0',
                'description' => 'Switch from fluid / none-fluid container',
                'type' => 'boolean',
                'locked' => 0
            ],
            [
                'key' => 'design.bottom_container_fluid',
                'value' => '0',
                'description' => 'Switch from fluid / none-fluid container',
                'type' => 'boolean',
                'locked' => 0
            ]
        ];

        foreach($settings as $setting){
            Settings::insert($setting);
        }
    }
}
