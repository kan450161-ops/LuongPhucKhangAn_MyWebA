<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductImageDeletionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_deletes_a_product_image_from_storage_and_database(): void
    {
        Storage::fake('public');

        $category = Category::create([
            'catename' => 'Test Category',
            'slug' => 'test-category',
            'status' => 1,
        ]);

        $brand = Brand::create([
            'brandname' => 'Test Brand',
            'slug' => 'test-brand',
            'status' => 1,
        ]);

        $product = Product::create([
            'productname' => 'Test Product',
            'slug' => 'test-product',
            'cateid' => $category->cateid,
            'brandid' => $brand->id,
            'price' => 100000,
            'description' => 'Test description',
            'status' => 1,
            'image' => null,
        ]);

        $imageName = 'product-1_123_1.jpg';
        Storage::disk('public')->put('products/' . $imageName, 'fake-content');

        $image = ProductImage::create([
            'product_id' => $product->id,
            'image' => $imageName,
        ]);

        $response = $this->deleteJson(route('admin.products.images.destroy', [$product->id, $image->id]));

        $response->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseMissing('product_images', ['id' => $image->id]);
        Storage::disk('public')->assertMissing('products/' . $imageName);
    }
}
