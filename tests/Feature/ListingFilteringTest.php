<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListingFilteringTest extends TestCase
{
    use RefreshDatabase;

    public function test_listings_index_returns_only_active_listings(): void
    {
        Listing::factory()->create(['status' => 'Active', 'name' => 'Active Listing']);
        Listing::factory()->create(['status' => 'Draft', 'name' => 'Draft Listing']);

        $response = $this->get(route('listings.index'));

        $response->assertStatus(200);
        $response->assertSee('Active Listing');
        $response->assertDontSee('Draft Listing');
    }

    public function test_listings_can_be_filtered_by_location(): void
    {
        Listing::factory()->create(['address' => 'Downtown Dubai', 'name' => 'Downtown Apt']);
        Listing::factory()->create(['address' => 'Dubai Marina', 'name' => 'Marina Apt']);

        $response = $this->get(route('listings.index', ['location' => 'Downtown']));

        $response->assertSee('Downtown Apt');
        $response->assertDontSee('Marina Apt');
    }

    public function test_listings_can_be_filtered_by_property_types(): void
    {
        Listing::factory()->create(['property_type' => 'Apartment', 'name' => 'Nice Apartment']);
        Listing::factory()->create(['property_type' => 'Villa', 'name' => 'Big Villa']);

        $response = $this->get(route('listings.index', ['property_types' => ['Apartment']]));

        $response->assertSee('Nice Apartment');
        $response->assertDontSee('Big Villa');
    }

    public function test_listings_can_be_filtered_by_bedrooms(): void
    {
        Listing::factory()->create(['bedrooms' => '1', 'name' => 'One Bedroom']);
        Listing::factory()->create(['bedrooms' => '2', 'name' => 'Two Bedrooms']);

        $response = $this->get(route('listings.index', ['bedrooms' => ['1']]));

        $response->assertSee('One Bedroom');
        $response->assertDontSee('Two Bedrooms');
    }

    public function test_listings_can_be_filtered_by_price_range(): void
    {
        Listing::factory()->create(['price' => 5000, 'name' => 'Cheap Apt']);
        Listing::factory()->create(['price' => 15000, 'name' => 'Expensive Apt']);

        $response = $this->get(route('listings.index', [
            'min_price' => 4000,
            'max_price' => 6000
        ]));

        $response->assertSee('Cheap Apt');
        $response->assertDontSee('Expensive Apt');
    }
}
