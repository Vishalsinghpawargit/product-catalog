<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use RefreshDatabase , WithFaker;

    public function test_category_create_and_success_response()
    {
        $data = [
            'name' => fake()->name(),
        ];

        $response = $this->postJson('/api/v1/category' , $data);

        $response->assertStatus(201);

    }

    public function test_category_create_is_giving_validation_error()
    {
        $data = [];

        $response = $this->postJson('/api/v1/category' , $data);

        $response->assertStatus(422);
    }


}