<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use  WithFaker;

    public function test_category_is_stroing_and_success_response()
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

    public function test_product_is_storing_and_success_reponse()
    {

        $category = Category::first();

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
