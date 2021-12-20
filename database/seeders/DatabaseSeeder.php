<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Cards;
use App\Models\Lists;
use App\Models\Subscriptions;
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
        User::factory()->create(['email' => 'admin@admin.com', 'role' => 'ADMIN']);
        User::factory()->create(['email' => 'user@user.com']);
        User::factory(8)->create();
        Subscriptions::factory(10)->create();
        Lists::factory(30)->create();
        Cards::factory(50)->create();
    }
}
