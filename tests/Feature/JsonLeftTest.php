<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\JsonLeft;
use Tests\TestCase;

class JsonLeftTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'http://localhost:8080/api/v1';

    /** @test */
    public function a_json_left_can_be_added()
    {
        $params = [
            'code' => 1,
            'json_base64' => base64_encode($this->sampleJson())
        ];

        $this->json('POST', $this->uri . '/diff/1/left', $params, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'code',
                'json_base64',
                'updated_at',
                'created_at',
                'id'
            ]);

        $this->assertCount(1, JsonLeft::all());
    }

    /** @test */
    public function an_url_id_must_be_integer()
    {
        $params = [
            'code' => 1,
            'json_base64' => base64_encode($this->sampleJson())
        ];

        $uri = $this->uri . '/diff/teste/left';

        $this->json('POST', $uri, $params, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'id' => ['The id must be an integer.']
                ]
            ]);
    }

    /** @test */
    public function a_json_base64_is_required()
    {
        $params = [
            'code' => 1,
            'json_base64' => ''
        ];

        $uri = $this->uri . '/diff/1/left';

        $this->json('POST', $uri, $params, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'json_base64' => ['The json base64 field is required.']
                ]
            ]);
    }

    /** @test */
    public function a_json_base64_must_be_atring()
    {
        $params = [
            'code' => 1,
            'json_base64' => 123456789
        ];

        $uri = $this->uri . '/diff/1/left';

        $this->json('POST', $uri, $params, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'json_base64' => [
                        'The json base64 must be a string.',
                        'json base64 is not a valid base64 string'
                    ]
                ]
            ]);
    }

    /** @test */
    public function a_json_base64_has_invalid_base64_string()
    {
        $params = [
            'code' => 1,
            'json_base64' => 'test-invalid'
        ];

        $uri = $this->uri . '/diff/1/left';

        $this->json('POST', $uri, $params, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'json_base64' => ['json base64 is not a valid base64 string']
                ]
            ]);
    }

    private function sampleJson()
    {
        return json_encode([
            'name' => 'Alisson',
            'last_name' => 'Pádua'
        ]);
    }
}
