<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        // A few clearly named examples
        Task::factory()->create([
            'name' => 'Prepare project proposal',
            'description' => 'Draft the outline and collect references.',
            'status' => 'todo',
            'due_date' => now()->addDays(7),
        ]);

        Task::factory()->create([
            'name' => 'Design wireframes',
            'description' => 'Create low-fidelity wireframes for the dashboard.',
            'status' => 'doing',
            'due_date' => now()->addDays(3),
        ]);

        Task::factory()->create([
            'name' => 'Team stand-up',
            'description' => 'Daily sync meeting at 10:00.',
            'status' => 'done',
            'due_date' => now()->subDay(),
        ]);

        // And a bunch of random tasks
        Task::factory(30)->create();
    }
}
