<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ValidatePayloadTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation_passes()
    {
        $payload = [
            "first_name" => [
                "value" => "John",
                "rules" => "alpha|required"
            ],
            "last_name" => [
                "value" => "Doe",
                "rules" => "alpha|required"
            ],
            "email" => [
                "value" => "Doe@gmail.com",
                "rules" => "email"
            ],
            "phone" => [
                "value" => "08175020329",
                "rules" => "number"
            ]
        ];
        $response = $this->post('/api/validate-payload', $payload, ['Accept' => 'application/json']);

        $response->assertStatus(200);
        $response->assertJsonStructure(['status']);
    }

    public function test_field_is_required()
    {
        $payload = [
            "first_name" => [
                "value" => "",
                "rules" => "alpha|required"
            ],
        ];
        $response = $this->post('/api/validate-payload', $payload, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);
    }

    public function test_field_must_be_alpha()
    {
        $payload = [
            "first_name" => [
                "value" => "John34",
                "rules" => "alpha|required"
            ],
            "last_name" => [
                "value" => "",
                "rules" => "alpha|required"
            ],
        ];
        $response = $this->post('/api/validate-payload', $payload, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);
    }

    public function test_field_must_be_email()
    {
        $payload = [
            "email" => [
                "value" => "Doe",
                "rules" => "email"
            ],
        ];
        $response = $this->post('/api/validate-payload', $payload, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);
    }

    public function test_field_must_be_number()
    {
        $payload = [
            "email" => [
                "value" => "Doe",
                "rules" => "email"
            ],
            "phone" => [
                "value" => "JOKE08175020329",
                "rules" => "number"
            ]
        ];
        $response = $this->post('/api/validate-payload', $payload, ['Accept' => 'application/json']);

        $response->assertStatus(422);
        $response->assertJsonStructure(['message', 'errors']);
    }
}
