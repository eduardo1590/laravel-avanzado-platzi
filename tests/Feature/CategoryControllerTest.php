<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Category;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        factory(Category::class, 5)->create();

        //$response = $this->json('GET', '/api/categorys');
        $response = $this->getJson('/api/categories');

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $response->assertJsonCount(5);
    }

    public function testStore()
    {
        $data = [
            'name' => 'Bujias',
        ];
        $response = $this->postJson('/api/categories', $data);

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDatabaseHas('categories', $data);
    }

    public function testUpdate()
    {
        $category = factory(Category::class)->create();

        $data = [
            'name' => 'Update category',
        ];

        $response = $this->patchJson("/api/categories/$category->id", $data);
        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function testShow(){
        $category = factory(Category::class)->create();

        $response = $this->getJson("/api/categories/$category->id");

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
    }

    public function testDestroy()
    {
        $category = factory(Category::class)->create();

        $response = $this->deleteJson("/api/categories/$category->id");

        $response->assertSuccessful();
        $response->assertHeader('content-type', 'application/json');
        $this->assertDeleted($category);
    }
}
