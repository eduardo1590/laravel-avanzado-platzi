<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Category;
use App\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_belongs_to_category()
    {
        $category = factory(Category::class)->create();
        $product = factory(Product::class)->create(['category_id' => $category]);

        $this->assertInstanceOf(Category::class, $product->category);
    }
}
