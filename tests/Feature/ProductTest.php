<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
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

    public function test_product_create_requires_name_price_and_category_id()
    {
        $response = $this->postJson('/api/v1/product', [
            'sku' => fake()->ean13()
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'price', 'category_id']);
    }

    public function test_product_index_returns_paginated_products()
    {
        $category = Category::factory()->create();

        // Create 15 products
        $products = Product::factory()
            ->count(15)
            ->create([
                'category_id' => $category->id,
            ]);

        $response = $this->getJson('/api/v1/product?limit=10&orderBy=updated_at&sortBy=desc');

        $response->assertStatus(200);
        
        // Check that the pagination meta is present
        $response->assertJsonStructure([
            'data',
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'per_page',
                'to',
                'total',
            ],
        ]);

        // Ensure 10 results are returned
        $this->assertCount(10, $response->json('data'));
    }

    public function test_product_index_returns_not_found_if_empty()
    {
        $response = $this->getJson('/api/v1/product');

        $response->assertStatus(404);
        $response->assertJson(['message' => 'No products found']);
    }

    public function test_product_index_order_by_asc_results()
    {
        $category = Category::factory()->create();

        Product::factory()->create(['name' => 'Apple', 'category_id' => $category->id]);
        Product::factory()->create(['name' => 'Zebra', 'category_id' => $category->id]);

        $response = $this->getJson('/api/v1/product?orderBy=name&sortBy=asc');

        $response->assertStatus(200);
        $this->assertEquals('Apple', $response->json('data')[0]['name']);
    }

    public function test_product_index_order_by_desc_results()
    {
        $category = Category::factory()->create();

        Product::factory()->create(['name' => 'Apple', 'category_id' => $category->id]);
        Product::factory()->create(['name' => 'Zebra', 'category_id' => $category->id]);

        $response = $this->getJson('/api/v1/product?orderBy=name&sortBy=desc');

        $response->assertStatus(200);
        $this->assertEquals('Zebra', $response->json('data')[0]['name']);
    }

}
