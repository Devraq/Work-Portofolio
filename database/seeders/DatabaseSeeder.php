<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Main database seeder.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
