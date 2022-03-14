<?php

namespace Database\Factories;

use App\Models\Magic;
use App\Models\MagicPhrase;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MagicPhrase>
 */
class MagicPhraseFactory extends Factory
{

    protected $model = MagicPhrase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(20),
            'notified' => false,
            'updated_at' => now(),
            'magic_id' => Magic::first()->id,
        ];
    }
}
