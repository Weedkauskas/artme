<?php

namespace Tests\Unit;

use App\Facades\EmailHelperFacade;
use App\Models\Subscription;
use App\Repositories\SubscriptionRepository;
use App\Services\SubscriptionService;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\CreatesApplication;

class SubscriptionUnitTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    private $repository;
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new SubscriptionRepository();
        $this->service = new SubscriptionService($this->repository);
    }

    /**
     * Test subscribe
     */

    public function test_subscribe_service()
    {
        //Fake event
        Event::fake();

        //Subscribe
        $subscribe = $this->service->subscribe('test@test.lt', 'Test');

        //Return
        $this->assertEquals(1, $subscribe->count());

        //Same return?
        $this->assertEquals($subscribe->email, 'test@test.lt');
        $this->assertEquals($subscribe->name, 'Test');

        //Model count
        $this->assertCount(1, Subscription::all());

        //Same model record?
        $first = Subscription::first();

        $this->assertEquals($first->email, 'test@test.lt');
        $this->assertEquals($first->name, 'Test');
    }

    /**
     * Test with 2 same emails
     */

    public function test_subscribe_exist_service()
    {
        //Fake event
        Event::fake();

        //Subscribe
        $this->service->subscribe('test@test.lt', 'Test');
        $subscribe = $this->service->subscribe('test@test.lt', 'Test');

        //Exists
        $this->assertEquals(0, $subscribe);
        $this->assertCount(1, Subscription::all());
    }

    /**
     * Test unsubscribe
     */

    public function test_unsubscribe_service()
    {
        $subscription = Subscription::factory()->create();

        //Created
        $this->assertCount(1, Subscription::all());

        //Unsubscribe
        $delete = $this->service->unsubscribe($subscription->email, $subscription->hash);

        //Unsubscribed?
        $this->assertEquals(1, $delete);
        $this->assertCount(0, Subscription::all());
    }

    /**
     * Test custom facade "static" call
     */

    public function test_custom_facade()
    {
        $facade = new EmailHelperFacade();

        $success = $facade::success();

        $this->assertEquals('success', $success);
    }
}
