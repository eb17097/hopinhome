<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateListingTest extends DuskTestCase
{
    /**
     * Test that a property manager can successfully create a listing via the wizard.
     */
    public function test_property_manager_can_create_listing(): void
    {
        $user = User::factory()->propertyManager()->create([
            'onboarding_completed' => true,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visitRoute('property_manager.listings.create')
                    ->waitForText('Create a listing')
                    
                    // Step 1: Property Type
                    ->waitForText('What type of listing are you adding?')
                    // Target the div that has the Alpine click handler
                    ->clickAtXPath('//h4[contains(text(), "Apartment")]/ancestor::div[contains(@class, "cursor-pointer")]')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 2: Location
                    ->waitForText('Where is your property located?', 10)
                    ->type('address', '123 Test Street, Dubai, UAE')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 3: Name & Description
                    ->waitForText('Let’s start with the details')
                    ->type('name', 'Dusk Test Luxury Apartment')
                    ->type('description', 'This is a test description for a luxury apartment.')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 4: More property details
                    ->waitForText('More property details')
                    ->type('area', 1200)
                    ->type('floor_number', 12)
                    ->type('total_floors', 50)
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 5: Features
                    ->waitForText('What features does your property have?')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 6: Amenities
                    ->waitForText('What amenities does your property have?')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 7: Photos
                    ->waitForText('Add photos of your property')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 8: Video
                    ->waitForText('Add a video tour')
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 9: Pricing
                    ->waitForText('How much will the property cost to rent?')
                    ->type('price', 75000)
                    ->pause(500)
                    ->press('Next')
                    
                    // Step 10: Review
                    ->waitForText('Submit Listing')
                    ->press('Submit Listing')
                    
                    // Verification
                    ->waitForLocation('/property-manager', 15)
                    ->assertSee('New listing created successfully!');
        });
    }
}
