<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_may_get_a_list_of_all_products()
    {
        factory(Product::class, 5)->create();
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->withoutExceptionHandling()
        ->getJson(route('product.index'))
        ->assertOk()
        ->assertJsonCount(5)
        ->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'description',
                'price',
                'image'
            ]
        ]);
    }

    /** @test */
    public function an_unauthorized_user_may_not_get_product_list()
    {
        $this->getJson(route('product.index'))
            ->assertUnauthorized();
    }

    /** @test */
    public function a_user_may_add_a_product()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $product = factory(Product::class)->make();
        $this->withoutExceptionHandling()
        ->postJson(route('product.store'), $product->toArray())
        ->assertOk()
        ->assertJson([
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price']
        ]);

        $this->assertDatabaseHas('products', [
            'name' => $product['name'],
            'description' => $product['description'],
            'price' => $product['price']
        ]);
    }

    /** @test */
    public function a_product_has_required_fields()
    {
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->postJson(route('product.store'), [])
        ->assertJsonValidationErrors([
            'name',
            'description',
            'price'
        ]);
    }

    /** @test */
    public function a_user_may_update_a_product()
    {
        $product = factory(Product::class)->create();
        $change = [
            'name' => "changed name",
            'description' => "changed description",
            'price' => "9999"
        ];
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->withoutExceptionHandling()
        ->patchJson(route('product.update', $product), $change)
        ->assertOk()
        ->assertJson([
            'name' => $change['name'],
            'description' => $change['description'],
            'price' => $change['price']
        ]);

        $product = $product->fresh();
        $this->assertEquals($change['name'], $product->name);
        $this->assertEquals($change['description'], $product->description);
        $this->assertEquals($change['price'], $product->price);
    }

    /** @test */
    public function updating_a_product_has_required_fields()
    {
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->patchJson(route('product.update', $product), [])
        ->assertJsonValidationErrors([
            'name',
            'description',
            'price'
        ]);
    }

    /** @test */
    public function a_user_may_delete_a_product()
    {
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->withoutExceptionHandling()
        ->deleteJson(route('product.destroy', $product))
        ->assertOk();

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    /** @test */
    public function a_user_may_see_a_product()
    {
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->withoutExceptionHandling()
        ->getJson(route('product.show', $product))
        ->assertOk()
        ->assertJson([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'image' => $product->image,
        ]);
    }

    /** @test */
    public function a_user_may_upload_an_image()
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->image('someImage.jpg');
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->withoutExceptionHandling()
        ->patchJson(route('product.upload', $product), ['image' => $file])
        ->assertOk();

        Storage::disk('public')->assertExists('images/'.$file->hashName());

        $product = $product->fresh();
        $this->assertEquals('images/'.$file->hashName(), $product->image);
    }

    /** @test */
    public function file_upload_must_be_an_image()
    {
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            factory(User::class)->create(),
            ['*']
        );
        $this->patchJson(route('product.upload', $product), ['image' => 'not an image'])
        ->assertJsonValidationErrors(['image']);
    }
}
