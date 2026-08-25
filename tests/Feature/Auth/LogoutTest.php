<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_guest_cannot_logout(): void
    {
        $response = $this->post(route('logout'));

        $response->assertRedirect(route('login'));
    }
}
