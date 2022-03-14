<?php

namespace Tests\Feature;

use App\Models\Magic;
use App\Models\MagicPhrase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MagicTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_add_new_magic()
    {
        //$this->withoutExceptionHandling();

        $response = $this->post('/add-magic',
            [
                'title' => 'Magic',
            ]
        );

        $response->assertRedirect('/');

        //Created
        $this->assertCount(1, Magic::all());

        //Same
        $magic = Magic::first();

        $this->assertEquals($magic->title, 'Magic');
    }

    public function test_visualise_page()
    {
        $magic = Magic::factory()->create();

        $response = $this->get('/visualise/' . $magic->slug);

        $response->assertStatus(200);
    }

    public function test_add_phrase_api()
    {
        $magic = Magic::factory()->create();

        $this->json('POST', route('add_phrase'),
            [
                'magic_id' => $magic->id,
                'phrase' => 'Magic phrase',
                'description' => 'Testing',
            ]
        );

        //Created
        $this->assertCount(1, MagicPhrase::all());

        //Same
        $phrase = MagicPhrase::first();

        $this->assertEquals($phrase->title, 'Magic phrase');
        $this->assertEquals($phrase->description, 'Testing');
    }

    public function test_delete_phrase_api()
    {
        Magic::factory()->create();
        $phase = MagicPhrase::factory()->create();

        //Created
        $this->assertCount(1, MagicPhrase::all());

        //Delete
        $this->json('DELETE', route('delete_phrase', $phase->id));

        //Deleted
        $this->assertCount(0, MagicPhrase::all());
    }

    public function test_view_phrase_api()
    {
        //Create factory
        Magic::factory()->create();
        $phase = MagicPhrase::factory()->create();

        //Created
        $this->assertCount(1, MagicPhrase::all());

        //View
        $json = $this->json('GET', route('view_phrase', $phase->id));

        //Check status
        $json->assertStatus(200);

        //Check json
        $data = ['title' => $phase->title, 'description' => $phase->description];
        $json->assertJson(['data' => $data]);
    }
}
