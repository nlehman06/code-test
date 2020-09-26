<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use App\Subscription;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProductsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_may_see_the_list_of_their_products()
    {
        factory(Subscription::class)->create();
        $user = factory(User::class)->state('subscribed')->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $product1 = factory(Product::class)->create();
        $product2 = factory(Product::class)->create();
        $user->products()->attach($product1->id);
        $user->products()->attach($product2->id);
        $this->withoutExceptionHandling()
        ->getJson(route('userProducts.index'))
        ->assertOk()
        ->assertJsonCount(2);
    }

    /** @test */
    public function a_subscribed_user_may_add_product_to_their_list()
    {
        factory(Subscription::class)->create();
        $user = factory(User::class)->state('subscribed')->create();
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $this->withoutExceptionHandling()
        ->postJson(route('userProducts.store'), ['productId' => $product->id])
        ->assertOk();
        $this->assertCount(1, $user->fresh()->products);
    }

    /** @test */
    public function user_must_add_a_valid_product()
    {
        factory(Subscription::class)->create();
        $user = factory(User::class)->state('subscribed')->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $this->postJson(route('userProducts.store'), ['productId' => 99])
        ->assertJsonValidationErrors(['productId']);
    }

    /** @test */
    public function a_user_must_be_subscribed_to_add_products_to_their_list()
    {
        factory(Subscription::class)->create();
        $user = factory(User::class)->state('expired')->create();
        $product = factory(Product::class)->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );
        $this->postJson(route('userProducts.store'), ['productId' => $product->id])
        ->assertStatus(403);
    }
    /** @test */
    public function a_user_may_remove_their_own_products()
    {
        factory(Subscription::class)->create();
        $product = factory(Product::class)->create();
        $user = factory(User::class)->state('expired')->create();
        $user->products()->attach($product->id);

        $this->assertCount(1, $user->fresh()->products);

        Sanctum::actingAs(
            $user,
            ['*']
        );
        $this->withoutExceptionHandling()
            ->deleteJson(route('userProducts.destroy'), ['productId' => $product->id])
            ->assertOk()
            ->assertJsonCount(0);

        $this->assertCount(0, $user->fresh()->products);
    }
}
