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
                    'name' => '3D Modeling',
                    'description' => 'Create 3D models for a client',
                    'image' => 'assets/imgs/services/3d-modeling.png',
                ],
                [
                    'name' => 'NFC Cards',
                    'description' => 'Create NFC cards for a client',
                    'image' => 'assets/imgs/services/nfc-cards.png',
                ],
                [
                    'name' => '3D Printing',
                    'description' => 'Print 3D models for a client',
                    'image' => 'assets/imgs/services/3d-printing.png',
                ],
            ]
        );
    }
}
