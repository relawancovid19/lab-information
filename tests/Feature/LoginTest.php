<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCanAccessLogin()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
