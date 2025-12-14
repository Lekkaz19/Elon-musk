<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware; // Add this line

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;
    use WithoutMiddleware; // Use the trait

    protected function setUp(): void
    {
        parent::setUp();
        config(['session.driver' => 'array']); // Explicitly set session driver for tests
    }
}
