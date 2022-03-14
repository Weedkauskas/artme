<?php

namespace Database\Factories;

use App\Models\Magic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Magic>
 */
class MagicFactory extends Factory
{
    protected $model = Magic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'slug' => $this->faker->slug(2),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
