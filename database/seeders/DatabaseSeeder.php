<?php

namespace Database\Seeders;

use App\Models\MessageModel;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
        ]);
        User::factory(10)->create();
        MessageModel::factory(40)->create();
        for ($i=1; $i <=20 ; $i++) {
            MessageModel::factory(rand(1,5))->replies(rand(1,40))->create();
        }

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
