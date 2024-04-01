<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/books');

        $response->assertStatus(200);
    }
}
