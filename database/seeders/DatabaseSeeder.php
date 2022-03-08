<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@example.com')->first();

        if (! $user) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'Password123#@!',
            ]);
        }

        $this->call(SupplierSeeder::class);
        $this->call(WarehouseSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(ClientSeeder::class);
    }
}
