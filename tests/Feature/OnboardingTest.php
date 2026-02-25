<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OnboardingTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_user_is_redirected_to_onboarding(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertRedirect(route('onboarding.index'));
        
        $response = $this->actingAs($user)->get('/onboarding');
        $response->assertStatus(200);
        $response->assertSee('Let’s get started');
    }

    public function test_user_can_complete_onboarding_step_1(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'onboarding_step' => 1,
        ]);

        $response = $this->actingAs($user)->postJson(route('onboarding.step1'), [
            'role_intent' => 'renter',
        ]);

        $response->assertJson([
            'status' => 'success',
            'redirect' => route('onboarding.index'),
        ]);

        $user->refresh();
        $this->assertEquals('renter', $user->role);
        $this->assertEquals(2, $user->onboarding_step);
    }

    public function test_user_is_redirected_to_dashboard_if_onboarding_completed(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'onboarding_completed' => true,
        ]);

        $response = $this->actingAs($user)->get('/onboarding');

        $response->assertRedirect(route('dashboard'));
    }
}
