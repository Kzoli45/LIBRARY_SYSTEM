<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MembersTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/members');

        $response->assertStatus(200);
    }
}
