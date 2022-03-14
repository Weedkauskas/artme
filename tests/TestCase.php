<?php

namespace Tests;
use App\Interfaces\MagicServiceInterface;
use App\Services\MagicService;
use Mockery\MockInterface;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

}
