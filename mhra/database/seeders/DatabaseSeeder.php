<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Agenda;
use App\Models\AnnualConference;
use App\Models\Blog;
use App\Models\Employee;
use App\Models\Event;
use App\Models\GeneralInfo;
use App\Models\Speaker;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        GeneralInfo::factory()->create();
        Employee::factory(10)->create();
        Speaker::factory(10)->create();
        Blog::factory(10)->create();
        Event::factory(10)->create();
        AnnualConference::factory(10)->create();
        Ticket::factory(10)->create();
        Agenda::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
        ]);
    }
}
