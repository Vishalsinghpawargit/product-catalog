<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    public function test_product_create_and_success_response()
    {

        $category = Category::factory()->create();

        $data = [
            'name' => fake()->name(),
            'price' => fake()->randomFloat(2,0,1000),
            'sku' => fake()->ean13(),
            'category_id' => $category->id
        ];

        // Send a POST request with the correct data
        $response = $this->postJson('/api/v1/product', $data);

        // Check that the response is a success
        $response->assertStatus(201); 

    }

    public function test_product_create_is_giving_validation_error()
    {
        $data = [];

        // Send a POST request with the correct data
        $response = $this->postJson('/api/v1/product', $data);

        // Check that the response is a success
        $response->assertStatus(422); 

    }
}
