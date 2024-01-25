<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class QuoteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_quote_controller_index_returns_a_successful_response()
    {
        $givenQuotes = [
            ['quote' => 'All you have to be is yourself'],
            ['quote' => 'Keep squares out yo circle'],
            ['quote' => 'Manga all day'],
            ['quote' => 'I\'m a creative genius'],
            ['quote' => 'We all self-conscious. I\'m just the first to admit it.'],
        ];

        $expectedResponse = json_encode([
            'data' => [
                'All you have to be is yourself',
                'Keep squares out yo circle',
                'Manga all day',
                'I\'m a creative genius',
                'We all self-conscious. I\'m just the first to admit it.',
            ]
        ]);

        Http::fake([
            '*' => Http::sequence(
                $givenQuotes
            )
        ]);

        $response = $this
            ->actingAs(User::factory()->create(), 'api')
            ->getJson('/api/quotes');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertContent($expectedResponse);
    }

    public function test_the_quote_controller_index_unauthenticated_response()
    {
        $response = $this->getJson('/api/quotes');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_the_quote_controller_update_returns_a_successful_response()
    {
        $givenQuotes = [
            ['quote' => 'All you have to be is yourself'],
            ['quote' => 'Keep squares out yo circle'],
            ['quote' => 'Manga all day'],
            ['quote' => 'I\'m a creative genius'],
            ['quote' => 'We all self-conscious. I\'m just the first to admit it.'],
        ];

        $expectedResponse = json_encode([
            'data' => [
                'All you have to be is yourself',
                'Keep squares out yo circle',
                'Manga all day',
                'I\'m a creative genius',
                'We all self-conscious. I\'m just the first to admit it.',
            ]
        ]);

        Http::fake([
            '*' => Http::sequence(
                $givenQuotes
            )
        ]);

        $response = $this
            ->actingAs(User::factory()->create(), 'api')
            ->json(Request::METHOD_PUT, '/api/quotes');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertContent($expectedResponse);
    }

    public function test_the_quote_controller_update_unauthenticated_response()
    {
        $response = $this->json(Request::METHOD_PUT, '/api/quotes');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    public function test_the_quote_controller_delete_returns_a_successful_response()
    {
        $response = $this
            ->actingAs(User::factory()->create(), 'api')
            ->json(Request::METHOD_DELETE, '/api/quotes');

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $response->assertNoContent();
    }

    public function test_the_quote_controller_delete_unauthenticated_response()
    {
        $response = $this->json(Request::METHOD_DELETE, '/api/quotes');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
