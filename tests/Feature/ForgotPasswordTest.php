<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_forgot_password_page(): void
    {
        $response = $this->get(route('admin.forgotpass'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.forgot-password');
    }

    public function test_admin_can_request_password_reset_with_existing_email(): void
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'username' => 'admin',
            'password' => bcrypt('secret123'),
        ]);

        $response = $this->post(route('admin.forgotpass.post'), [
            'email' => 'admin@example.com',
        ]);

        $response->assertRedirect(route('admin.forgotpass'));
        $response->assertSessionHas('status');
    }
}
