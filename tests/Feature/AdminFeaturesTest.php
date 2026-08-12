<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminFeaturesTest extends TestCase
{
    use WithFaker;

    public function test_dashboard_route_is_available(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }

    public function test_product_seeders_create_twenty_products(): void
    {
        $this->artisan('db:seed', ['--class' => 'DatabaseSeeder'])
            ->assertSuccessful();

        $this->assertDatabaseCount('products', 20);
    }
}
