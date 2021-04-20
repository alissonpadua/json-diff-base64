<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\JsonLeft;

class ComparationTest extends TestCase
{
    use RefreshDatabase;

    protected $uri = 'http://localhost:8080/api/v1';

    /** @test */
    public function left_right_json_should_be_iquals()
    {
        $sampleJson = json_encode([
            'name' => 'Alisson',
            'last_name' => 'Pádua'
        ]);

        $data = [
            'code' => 10,
            'json_base64' => base64_encode($sampleJson)
        ];

        $jsonLeft = JsonLeft::create($data);
        $jsonLeft->jsonRight()->create($data);

        $uri = $this->uri . '/diff/10';

        $this->json('GET', $uri, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'diff' => 'ARE_EQUALS',
            ]);
    }

    /** @test */
    public function left_right_json_should_have_different_size()
    {
        $sampleLeftJson = json_encode([
            'name' => 'Alisson',
            'last_name' => 'Pádua'
        ]);

        $sampleRighJson = json_encode([
            'name' => 'Alisson',
            'last_name' => 'de Pádua'
        ]);

        $data = [
            'code' => 10,
            'json_base64' => base64_encode($sampleLeftJson)
        ];

        $jsonLeft = JsonLeft::create($data);

        $data = [
            'code' => 10,
            'json_base64' => base64_encode($sampleRighJson)
        ];

        $jsonLeft->jsonRight()->create($data);

        $uri = $this->uri . '/diff/10';

        $this->json('GET', $uri, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'diff' => 'HAVE_DIFFERENT_SIZE',
            ]);
    }

    /** @test */
    public function left_right_json_should_be_different_with_same_size()
    {
        $sampleLeftJson = json_encode([
            'name' => 'Alisson',
            'last_name' => 'Pádua'
        ]);

        $sampleRighJson = json_encode([
            'name' => 'Pádua',
            'last_name' => 'Alisson'
        ]);

        $data = [
            'code' => 10,
            'json_base64' => base64_encode($sampleLeftJson)
        ];

        $jsonLeft = JsonLeft::create($data);

        $data = [
            'code' => 10,
            'json_base64' => base64_encode($sampleRighJson)
        ];

        $jsonLeft->jsonRight()->create($data);

        $uri = $this->uri . '/diff/10';

        $this->json('GET', $uri, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'diff' => 'ARE_DIFFERENT_AND_SAME_SIZE'
            ])
            ->assertJsonStructure([
                'diff',
                'diffs'  => ['*' => ['offset', 'length']],
            ]);
    }
}
