<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateListingTest extends DuskTestCase
{
    use DatabaseMigrations;

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
                    ->clickAtXPath('//div[contains(text(), "Apartment")]')
                    ->press('Next')
                    
                    // Step 2: Location
                    ->waitForText('Where is your property located?')
                    ->type('address', '123 Test Street, Dubai, UAE')
                    ->press('Next')
                    
                    // Step 3: Name & Description
                    ->waitForText('Let’s start with the details')
                    ->type('name', 'Dusk Test Luxury Apartment')
                    ->type('description', 'This is a test description for a luxury apartment created by Laravel Dusk. It features a great view and modern amenities.')
                    ->press('Next')
                    
                    // Step 4: More property details
                    ->waitForText('More property details')
                    ->type('area', 1200)
                    ->type('floor_number', 12)
                    ->type('total_floors', 50)
                    ->press('Next')
                    
                    // Step 5: Features
                    ->waitForText('What features does your property have?')
                    ->press('Next')
                    
                    // Step 6: Amenities
                    ->waitForText('What amenities does your property have?')
                    ->press('Next')
                    
                    // Step 7: Photos
                    ->waitForText('Add photos of your property')
                    ->press('Next')
                    
                    // Step 8: Video
                    ->waitForText('Add a video tour')
                    ->press('Next')
                    
                    // Step 9: Pricing
                    ->waitForText('How much will the property cost to rent?')
                    ->type('price', 75000)
                    ->press('Next')
                    
                    // Step 10: Review (Step 10 is usually a summary or just the last step)
                    ->waitForText('Submit Listing')
                    ->press('Submit Listing')
                    
                    // Verification
                    ->waitForLocation('/property-manager')
                    ->assertSee('New listing created successfully!');
        });
    }
}
