<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Free',
            'slug' => 'free',
            'buyable' => false,
            'price' => 0,
            'stripe_id' => '',
            'storage' => 5242880
        ]);

        Plan::create([
            'name' => 'Medium',
            'slug' => 'medium',
            'buyable' => true,
            'price' => 500,
            'stripe_id' => 'price_1IJkGpLiJcjcAUUzDJhROlre',
            'storage' => 10485760
        ]);

        Plan::create([
            'name' => 'Large',
            'slug' => 'large',
            'buyable' => true,
            'price' => 900,
            'stripe_id' => 'price_1IJkF7LiJcjcAUUz4slGZJcb',
            'storage' => 15728640
        ]);
    }
}
