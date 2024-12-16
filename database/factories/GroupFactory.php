<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'currency' => 'EUR',
            'picture' => 'https://picsum.photos/200/200',
            'invitation_token' => $this->faker->randomNumber(8, true),
            // owner id is an element in user table
            'owner_id' => User::factory(),
        ];
    }
}
