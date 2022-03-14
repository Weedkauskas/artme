<?php

namespace Database\Seeders;

use App\Models\Magic;
use Illuminate\Database\Seeder;

class MagicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Magic::create([
            'title' => 'PHP/Laravel',
        ]);

        Magic::create([
            'title' => 'Javascript',
        ]);

        Magic::create([
            'title' => 'SOLID',
        ]);
    }
}
