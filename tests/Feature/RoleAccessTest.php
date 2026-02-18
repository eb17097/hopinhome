<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_users_are_redirected_from_role_specific_dashboards(): void
    {
        $this->get(route('renter.index'))
            ->assertRedirect(route('login'));

        $this->get(route('property_manager.index'))
            ->assertRedirect(route('login'));
    }

    public function test_renter_can_access_renter_dashboard(): void
    {
        $user = User::factory()->renter()->create();

        $this->actingAs($user)
            ->get(route('renter.index'))
            ->assertOk();
    }

    public function test_renter_is_redirected_from_property_manager_dashboard(): void
    {
        $user = User::factory()->renter()->create();

        $this->actingAs($user)
            ->get(route('property_manager.index'))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('error', 'You do not have permission to access this page.');
    }

    public function test_property_manager_can_access_property_manager_dashboard(): void
    {
        $user = User::factory()->propertyManager()->create();

        $this->actingAs($user)
            ->get(route('property_manager.index'))
            ->assertOk();
    }

    public function test_property_manager_is_redirected_from_renter_dashboard(): void
    {
        $user = User::factory()->propertyManager()->create();

        $this->actingAs($user)
            ->get(route('renter.index'))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('error', 'You do not have permission to access this page.');
    }

    public function test_property_manager_can_create_a_listing(): void
    {
        $user = User::factory()->propertyManager()->create();

        $this->actingAs($user)
            ->get(route('property_manager.listings.create'))
            ->assertOk();
    }

    public function test_renter_cannot_create_a_listing(): void
    {
        $user = User::factory()->renter()->create();

        $this->actingAs($user)
            ->get(route('property_manager.listings.create'))
            ->assertRedirect(route('dashboard'))
            ->assertSessionHas('error', 'You do not have permission to access this page.');
    }
}
