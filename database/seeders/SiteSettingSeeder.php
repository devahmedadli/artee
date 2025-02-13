<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'name' => 'Artee',
            'logo' => 'logo.png',
            'favicon' => 'favicon.ico',
            'social_media' => [
                'facebook' => 'https://www.facebook.com',
                'instagram' => 'https://www.instagram.com',
                'twitter' => 'https://www.twitter.com',
                'linkedin' => 'https://www.linkedin.com',
                'youtube' => 'https://www.youtube.com',
            ],
            'contact' => [
                'phone' => '01234567890',
                'email' => 'info@example.com',
                'address' => '123 Main St, Anytown, USA',
            ],
            'colors' => [
                'primary'   => '#7c7258',
                'primary-dark' => '#635945',
                'primary-light' => '#CAF4FF',
                'secondary' => '#95E1D3',
                'secondary-dark' => '#73A698',
                'secondary-light' => '#D3F4EE',
                'tertiary'  => '#F38181',
                'tertiary-dark' => '#D36161',
                'tertiary-light' => '#F4A1A1',
            ],
        ]);
    }
}
