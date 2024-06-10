<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Hash;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelUser::create([
            'name' => 'John Doe',
            'nip' => '1234567',
            'password' => Hash::make('1234567'),
            'role' => 'admin'
        ]);
    }
}
