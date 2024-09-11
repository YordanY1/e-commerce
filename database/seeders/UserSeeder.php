<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Jeronimo Store',
            'email' => 'jeronimostore1@gmail.com',
            'password' => Hash::make('StoreJeronimo1#$'),
        ]);
    }
}
