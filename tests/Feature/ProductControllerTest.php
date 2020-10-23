<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use App\User;
use Laravel\Sanctum\Sanctum;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void{
        parent::setUp();

        Sanctum::actingAs(
            factory(User::class)->create()
        );
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->withoutExceptionHandling();
        //creamos los products
        factory(Product::class, 5)->create();

        //$response = $this->json('GET', '/api/products');
        $response = $this->getJson('/api/products');

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(5, 'data');
    }

    public function testStore()
    {
        $data = [
            'name' => 'Bujia',
            'price' => 1000,
        ];
        $response = $this->postJson('/api/products', $data);

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('products', $data);
    }

    public function testUpdate()
    {
        $product = factory(Product::class)->create();

        $data = [
            'name' => 'Update Product',
            'price' => 20000,
        ];

        $response = $this->patchJson("/api/products/$product->id", $data);
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function testShow(){
        $product = factory(Product::class)->create();

        $response = $this->getJson("/api/products/$product->id");

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function testDestroy()
    {
        $product = factory(Product::class)->create();

        $response = $this->deleteJson("/api/products/$product->id");

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDeleted($product);
    }
}
