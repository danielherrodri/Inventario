<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
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
        $this->call(CatalogoSeeder::class);
        $this->call(RolSeeder::class);
        User::factory()->count(20)->create();
        Product::factory()->count(20)->create();
    }
}
