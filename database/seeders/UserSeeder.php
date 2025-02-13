<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // $roles = Role::all();

        $users = [
            [
                'name'      => 'Admin User',
                'username'  => 'admin',
                'phone'     => '01010101010',
                'email'     => 'admin@example.com',
                'password'  => Hash::make('password'),
                'role'      => 'admin'
            ],
            [
                'name'      => 'Customer User',
                'username'  => 'customer',
                'phone'     => '01010101010',
                'email'     => 'customer@example.com',
                'password'  => Hash::make('password'),
                'role'      => 'customer'
            ],
            [
                'name'      => 'Freelancer User',
                'username'  => 'freelancer',
                'phone'     => '01010101010',
                'email'     => 'freelancer@example.com',
                'password'  => Hash::make('password'),
                'role'      => 'freelancer'
            ],
            
        ];

        foreach ($users as $userData) {
            // $role = $roles->where('name', $userData['role'])->first();
            $user = User::create([
                'name'      => $userData['name'],
                'username'  => $userData['username'],
                'phone'     => $userData['phone'],
                'email'     => $userData['email'],
                'password'  => $userData['password'],
                'role'      => $userData['role'],
            ]);
            // $user->role()->associate($role);
            $user->save();
            if ($userData['role'] === 'freelancer') {
                $freelancer = $user->freelancer()->create([
                    'bio'           => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.',
                    'website'       => 'https://www.example.com',
                    'country'       => 'USA',
                    'specification' => 'Web Developer',
                    'skills'        => 'Laravel, Vue.js, Tailwind CSS',
                ]);

                Chat::create([
                    'chatable_id'   => $user->id,
                    'chatable_type' => 'App\Models\User',
                    'admin_id'      => 1,
                ]);
            }
            if ($userData['role'] === 'customer') {
                $customer = $user->customer()->create([
                    'address' => '1234 Main St, Anytown, USA',
                ]);

                Chat::create([
                    'chatable_id'   => $user->id,
                    'chatable_type' => 'App\Models\User',
                    'admin_id'      => 1,
                ]);
            }
        }
    }
}
