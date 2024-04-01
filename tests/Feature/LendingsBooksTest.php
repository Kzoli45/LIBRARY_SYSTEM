<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Member;
use App\Models\Lending;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LendingsBooksTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $book = Book::factory()->create();
        $member = Member::factory()->create();
        $lending = Lending::factory()->create([
            'book_id' => $book->id,
            'member_id' => $member->id
        ]);

        $this->assertEquals($book->id, $lending->book_id);
    }
}
