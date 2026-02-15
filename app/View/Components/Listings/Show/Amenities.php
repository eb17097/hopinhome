<?php

namespace App\View\Components\Listings\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Amenities extends Component
{
    public array $iconMap = [
        'High-speed internet' => 'android_wifi_3_bar.svg',
        'Dishwasher' => 'dishwasher.svg',
        'Fully furnished' => 'dine_lamp.svg',
        'Air conditioner' => 'ac_unit.svg',
        'Pets allowed' => 'pet_supplies.svg',
        'Maid room' => 'local_laundry_service.svg', // Placeholder, using laundry
        'Balcony or terrace' => 'local_laundry_service.svg', // Placeholder
        'Hot Tub' => 'bathtub.svg', // Placeholder
        'Fireplace' => 'local_laundry_service.svg', // Placeholder
        'Swimming pool' => 'pool.svg',
        'Parking garage' => 'parking_sign.svg',
        'Security cameras' => 'camera_outdoor.svg',
        'Gym' => 'exercise.svg',
        'Elevator / lift' => 'elevator.svg',
        'Built in' => 'calendar_check.svg' // Placeholder for year
    ];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.listings.show.amenities');
    }
}
