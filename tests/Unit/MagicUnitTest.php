<?php

namespace Tests\Unit;

use App\Models\Magic;
use App\Models\MagicPhrase;
use App\Repositories\MagicRepository;
use App\Services\MagicService;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;

use App\Facades\EmailHelperFacade;


class MagicUnitTest extends TestCase
{
    use RefreshDatabase;
    use CreatesApplication;

    private $repository;
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = new MagicRepository();
        $this->service = new MagicService($this->repository);
    }

    /**
     * Test add and findBy and getAll
     */

    public function test_add_and_find_by_slug_and_all_magic()
    {
        $add = $this->service->add('Magic');

        //Got return
        $this->assertEquals(1, $add);

        //Let's test getAll service too
        $all = $this->service->getAll();
        $this->assertCount(1, $all);

        //Ok, we can also test findBySlug service function
        $first = $all->first();
        $find = $this->service->findBySlug($first->slug);

        //Same?
        $this->assertEquals($find->title, 'Magic');
    }

    /**
     * Test addPhrase and viewPhrase
     */

    public function test_add_and_view_phrase()
    {
        $magic = Magic::factory()->create();

        //Add test
        $add = $this->service->addPhrase($magic->id, 'Phrase', 'Test test');
        $this->assertEquals(1, $add);

        //Let's test viewPhrase too
        $phrase = $this->service->viewPhrase($add);

        $this->assertEquals($phrase->title, 'Phrase');
        $this->assertEquals($phrase->description, 'Test test');
    }

    /**
     * Test deletePhrase
     */

    public function test_delete_phrase()
    {
        Magic::factory()->create();
        $phase = MagicPhrase::factory()->create();

        //Created
        $this->assertCount(1, MagicPhrase::all());

        $delete = $this->service->deletePhrase($phase->id);
        $this->assertEquals(1, $delete);
        $this->assertCount(0, MagicPhrase::all());
    }
}
