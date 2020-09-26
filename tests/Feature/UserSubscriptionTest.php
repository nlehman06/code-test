<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Subscription;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserSubscriptionTest extends TestCase
{
    use RefreshDatabase;
    public $subscriptions;

    protected function setUp():void
    {
        parent::setup();
        if (!$this->subscriptions) {
            $this->subscriptions = factory(Subscription::class, 3)->create();
        }
    }

    /** @test */
    public function a_user_may_not_yet_be_subscribed()
    {
        $user = factory(User::class)->create();
        $this->assertFalse($user->isSubscribed());
    }

    /** @test */
    public function a_user_may_be_subscribed()
    {
        $user = factory(User::class)->state('subscribed')->create();
        $this->assertTrue($user->isSubscribed());
    }

    /** @test */
    public function a_user_subscription_may_be_expired()
    {
        $user = factory(User::class)->state('expired')->create();

        $this->assertTrue($user->isExpired());
        $this->assertFalse($user->isSubscribed());
    }
}
