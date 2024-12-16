<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->country(),
            'amount' => $this->faker->randomFloat(2, 10, 200),
            'date' => $this->faker->date(),
            'group_id' => Group::factory(),
            'paid_by' => GroupUser::factory()
        ];
    }
}
