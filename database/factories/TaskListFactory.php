<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskList>
 */
class TaskListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::pluck('id')->random(),
            'subject' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'start_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'end_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => $this->faker->randomElement(['new' ,'incomplete', 'complete']),
            'priority' => $this->faker->randomElement(['high' ,'meduim', 'low']),
            'is_active' => $this->faker->randomElement(['0' ,'1']),
        ];
    }
}
