<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\GroupUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpensePart>
 */
class ExpensePartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expense_id' => Expense::factory(),
            'due_by' => GroupUser::factory(),
        ];
    }
}
