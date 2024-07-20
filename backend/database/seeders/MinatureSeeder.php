<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Minature;

class MinatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Minature::factory()->create([
            'name' => 'Test Minature',
            'description' => 'This is a test minature.',
            'movement' => 10,
            'toughness' => 10,
            'save' => 10,
            'wounds' => 10,
            'leadership' => 10,
            'objectiveControl' => 10,
            'invulnerableSave' => 10,
            'points' => 10,
        ]);
    }
}
