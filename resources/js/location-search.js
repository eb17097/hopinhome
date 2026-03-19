// This function contains only the location search logic
window.locationSearchLogic = (initialLocation = '', defaultIcons = {}) => ({
    openFilter: null,
    location: initialLocation,
    locationQuery: '',
    locations: [],
    recentSearches: [],
    defaultLocations: [
        { id: 'def-1', name: 'Dubai, United Arab Emirates', area: '', icon: defaultIcons.world || '/images/world_one.svg' },
        { id: 'def-2', name: 'Downtown Dubai', area: 'Dubai', icon: defaultIcons.downtown || '/images/downtown_loc.svg' },
        { id: 'def-3', name: 'Burj Khalifa', area: 'Dubai', icon: defaultIcons.location || '/images/location_loc.svg' },
        { id: 'def-4', name: 'Palm Jumeirah', area: 'Dubai', icon: defaultIcons.street || '/images/street_loc.svg' },
        { id: 'def-5', name: 'Abu Dhabi', area: 'United Arab Emirates', icon: defaultIcons.world || '/images/world_one.svg' }
    ],
    autocompleteService: null,

    init() {
        this.loadRecentSearches();
        this.updateLocationsList();

        if (window.google && window.google.maps && window.google.maps.places) {
            this.autocompleteService = new google.maps.places.AutocompleteService();
        }

        this.$watch('locationQuery', (value) => {
            if (value.length < 2) {
                this.updateLocationsList();
                return;
            }
            this.fetchPredictions(value);
        });
    },

    loadRecentSearches() {
        try {
            const saved = localStorage.getItem('hopinhome_recent_searches');
            let searches = saved ? JSON.parse(saved) : [];
            this.recentSearches = searches.map((s, i) => ({
                id: s.id || `rcn-${Date.now()}-${i}`,
                name: s.name || '',
                area: s.area || '',
                icon: s.icon || defaultIcons.location || '/images/location_loc.svg'
            }));
        } catch (e) {
            this.recentSearches = [];
        }
    },

    saveSearch(loc) {
        if (!loc || !loc.name) return;
        let recent = this.recentSearches.filter(s => s.name !== loc.name);
        recent.unshift({
            id: loc.id && loc.id.startsWith('rcn-') ? loc.id : `rcn-${Date.now()}`,
            name: loc.name,
            area: loc.area || '',
            icon: loc.icon || defaultIcons.location || '/images/location_loc.svg'
        });
        this.recentSearches = recent.slice(0, 5);
        localStorage.setItem('hopinhome_recent_searches', JSON.stringify(this.recentSearches));
    },

    updateLocationsList() {
        this.locations = this.recentSearches.length > 0 ? [...this.recentSearches] : [...this.defaultLocations];
    },

    fetchPredictions(query) {
        if (!this.autocompleteService && window.google && window.google.maps && window.google.maps.places) {
            this.autocompleteService = new google.maps.places.AutocompleteService();
        }
        if (!this.autocompleteService) return;
        this.autocompleteService.getPlacePredictions({
            input: query,
            componentRestrictions: { country: 'ae' },
            types: ['geocode']
        }, (predictions, status) => {
            if (status === google.maps.places.PlacesServiceStatus.OK && predictions) {
                this.locations = predictions.map(p => {
                    let icon = defaultIcons.location || '/images/location_loc.svg';

                    if (p.types.includes('locality') || p.types.includes('administrative_area_level_1')) {
                        icon = defaultIcons.world || '/images/world_one.svg';
                    } else if (p.types.includes('neighborhood') || p.types.includes('sublocality')) {
                        icon = defaultIcons.downtown || '/images/downtown_loc.svg';
                    } else if (p.types.includes('route') || p.types.includes('street_address') || p.types.includes('subpremise') || p.types.includes('premise')) {
                        icon = defaultIcons.street || '/images/street_loc.svg';
                    }
                    return {
                        id: p.place_id,
                        name: p.structured_formatting.main_text,
                        area: p.structured_formatting.secondary_text,
                        icon: icon
                    };
                });
            } else {
                this.locations = [];
            }
        });
    },

    get filteredLocations() {
        return Array.isArray(this.locations) ? this.locations.slice(0, 5) : [];
    },

    selectLocation(loc) {
        if (!loc) return;
        this.location = loc.name;
        this.locationQuery = '';
        this.saveSearch(loc);
        this.openFilter = null;
    },

    slugify(text) {
        if (!text) return 'all';
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }
});

document.addEventListener('alpine:init', () => {
    Alpine.data('locationSearch', window.locationSearchLogic);
});
