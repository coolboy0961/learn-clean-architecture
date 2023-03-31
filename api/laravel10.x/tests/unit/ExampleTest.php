<?php

namespace Tests\Unit;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertEquals('unittest', env('APP_ENV'));
        $this->assertEquals('unittest', env('TEST_ENV'));
        $this->assertTrue(true);
    }
}
