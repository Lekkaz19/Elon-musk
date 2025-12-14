<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        // Dump the response content if it's not a 200
        if ($response->getStatusCode() !== 200) {
            echo $response->getContent();
        }

        $response->assertStatus(200);
    }
}
