<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeTest extends TestCase
{
    use \App\Traits\UtlTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $result = $this->tax(100);

        $this->assertEquals(110.00000000000001, $result);
    }
}
