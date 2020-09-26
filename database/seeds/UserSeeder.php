<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $john = factory(User::class)->state('subscribed')->create([
            'firstName' => 'James',
            'lastName' => 'Terrono',
            'email' => 'james.terrono@furthered.com',
        ]);
        $john->products()->attach([1,2]);
        $jane = factory(User::class)->state('expired')->create([
            'firstName' => 'Nathan',
            'lastName' => 'Lehman',
            'email' => 'nathan@nlehman.dev',
        ]);
        $jane->products()->attach([1,3]);
        factory(User::class, 3)->state('subscribed')->create();
        factory(User::class, 3)->state('expired')->create();
    }
}
