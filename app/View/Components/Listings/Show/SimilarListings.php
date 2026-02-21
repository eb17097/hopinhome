<?php

namespace App\View\Components\Listings\Show;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SimilarListings extends Component
{
    public $listing;
    public $similarListings;

    /**
     * Create a new component instance.
     */
    public function __construct($listing)
    {
        $this->listing = $listing;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->similarListings = \App\Models\Listing::where('id', '!=', $this->listing->id)
            ->with('images') // Eager load images to avoid N+1 issues
            ->inRandomOrder()
            ->take(4)
            ->get();
            
        return view('components.listings.show.similar-listings');
    }
}
