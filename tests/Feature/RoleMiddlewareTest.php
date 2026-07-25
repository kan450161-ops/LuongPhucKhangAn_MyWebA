<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::factory()->create([
            'role' => 2,
            'username' => 'customer-test',
            'email' => 'customer@example.com',
        ]);

        $this->actingAs( $customer );

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'role' => 1,
            'username' => 'admin-test',
            'email' => 'admin@example.com',
        ]);

        $this->actingAs($admin);

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);
    }
}
