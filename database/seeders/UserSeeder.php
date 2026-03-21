<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'vrm99ov@gmail.com'],
            [
                'name'     => 'Var Hovhannisyan',
                'email'    => 'vrm99ov@gmail.com',
                'phone' => '+37498797329',
                'password' => Hash::make('vahram12'),
                'city' => 'Hrazdan',
                'address' => 'Nar-Dos 22',
                'role'     => 'admin',
            ]
        );

        $this->command->info('✓ Admin user created: vrm99ov@gmail.com');
    }
}
