<?php

use App\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subscription::class)->create(['name' => 'hobby']);
        factory(Subscription::class)->create(['name' => 'pro']);
        factory(Subscription::class)->create(['name' => 'expert']);
    }
}
