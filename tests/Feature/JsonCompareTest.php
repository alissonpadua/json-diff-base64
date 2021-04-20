<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\JsonLeft;
use Tests\TestCase;

class JsonCompareTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'http://localhost:8080/api/v1';

    /** @test */
    public function json_left_not_found()
    {
        $uri = $this->uri . '/diff/99';

        $this->json('GET', $uri, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'json_left' => ['Json Left not found']
                ]
            ]);
    }

    /** @test */
    public function json_right_not_found()
    {
        JsonLeft::create([
            'code' => 10,
            'json_base64' => 'ewogICJuYW1lIjogImFMSVNTT04iCn0='
        ]);

        $params = [
            'code' => 10,
            'json_base64' => 'ewogICJuYW1lIjogImFMSVNTT04iCn0='
        ];

        $uri = $this->uri . '/diff/10';

        $this->json('GET', $uri, $params, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'json_right' => ['Json Right not found']
                ]
            ]);
    }
}
