<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_subscribe_page()
    {
        $response = $this->get('/subscribe');

        $response->assertStatus(200);
    }

    public function test_subscribe_post()
    {
        Event::fake();

        $response = $this->post('/subscribe',
            [
                'email' => 'test@test.lt',
                'name' => 'Name'
            ]
        );

        $response->assertRedirect('/subscribe?success=1');

        $this->assertCount(1, Subscription::all());

        //Same
        $magic = Subscription::first();

        $this->assertEquals($magic->email, 'test@test.lt');
        $this->assertEquals($magic->name, 'Name');
    }

    public function test_subscribe_email_exists_post()
    {
        Event::fake();

        $this->post('/subscribe',
            [
                'email' => 'test@test.lt',
                'name' => 'Name'
            ]
        );

        $response = $this->post('/subscribe',
            [
                'email' => 'test@test.lt',
                'name' => 'Name'
            ]
        );

        $response->assertRedirect('/subscribe?success=0');

        $this->assertCount(1, Subscription::all());
    }

    public function test_unsubscribe()
    {
        $subscription = Subscription::factory()->create();

        $response = $this->get(route('unsubscribe',
                [
                    'email' => $subscription->email,
                    'hash' => $subscription->hash
                ]
            )
        );

        $response->assertStatus(200);

        $this->assertCount(0, Subscription::all());
    }
}
