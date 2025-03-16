<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert(
            [
                [
                    'ar_name' => 'إنشاء نماذج 3D',
                    'en_name' => '3D Modeling',
                    'ar_description' => 'إنشاء نماذج 3D لعميل',
                    'en_description' => 'Create 3D models for a client',
                    'image' => 'assets/imgs/services/3d-modeling.png',
                ],
                [
                    'ar_name' => 'بطاقات NFC',
                    'en_name' => 'NFC Cards',
                    'ar_description' => 'إنشاء بطاقات NFC لعميل',
                    'en_description' => 'Create NFC cards for a client',
                    'image' => 'assets/imgs/services/nfc-cards.png',
                ],
                [
                    'ar_name' => 'طباعة 3D',
                    'en_name' => '3D Printing',
                    'ar_description' => 'طباعة نماذج 3D لعميل',
                    'en_description' => 'Print 3D models for a client',
                    'image' => 'assets/imgs/services/3d-printing.png',
                ],
            ]
        );
    }
}
