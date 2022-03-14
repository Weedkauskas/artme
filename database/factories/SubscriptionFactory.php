<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Magic>
 */
class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'hash' => $this->faker->bothify('?###??##'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
