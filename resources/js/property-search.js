document.addEventListener('alpine:init', () => {
    Alpine.data('propertySearch', (config = {}) => {
        // Compose with location search logic
        const locationLogic = window.locationSearchLogic(config.initialLocation || '', config.icons || {});
        
        return {
            ...locationLogic,

            // Property Search State
            selectedPropertyTypes: config.selectedPropertyTypes || [],
            selectedBedrooms: config.selectedBedrooms || [],
            minPrice: config.minPrice || 0,
            maxPrice: config.maxPrice || 1000000,
            minRange: config.minRange || 0,
            maxRange: config.maxRange || 1000000,

            init() {
                // Call location logic init
                locationLogic.init.call(this);
            },

            // REDIRECTION LOGIC
            performSearch() {
                let locSlug = this.slugify(this.location);
                let typeSlug = this.selectedPropertyTypes.length > 0 ? this.selectedPropertyTypes.map(t => this.slugify(t)).join(',') : 'all';
                let bedSlug = this.selectedBedrooms.length > 0 ? this.selectedBedrooms.join(',') : 'all';
                let url = `/listings/search/${locSlug}/${typeSlug}/${bedSlug}`;
                
                let params = new URLSearchParams();
                if (this.minPrice > this.minRange) params.append('min_price', this.minPrice);
                if (this.maxPrice < this.maxRange) params.append('max_price', this.maxPrice);
                
                let queryString = params.toString();
                if (queryString) url += '?' + queryString;
                window.location.href = url;
            },

            // FORMATTING GETTERS
            get displayPropertyTypes() {
                if (this.selectedPropertyTypes.length === 0) return 'Property type';
                return this.selectedPropertyTypes.map(t => 
                    t.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')
                ).join(', ');
            },

            get formattedBedrooms() {
                if (this.selectedBedrooms.length === 0) return 'Bedrooms';
                let sorted = [...this.selectedBedrooms].sort((a, b) => 
                    (a === 'Studio' ? -1 : (b === 'Studio' ? 1 : parseInt(a) - parseInt(b)))
                );
                let studio = sorted.filter(v => v === 'Studio');
                let numbers = sorted.filter(v => v !== 'Studio');
                let result = [];
                if (studio.length > 0) result.push('Studio');
                if (numbers.length > 0) {
                    let suffix = (numbers.length === 1 && numbers[0] === '1') ? ' bedroom' : ' bedrooms';
                    result.push(numbers.join(', ') + suffix);
                }
                return result.join(', ');
            },

            get formattedPrice() {
                const min = this.minPrice || 0;
                const max = this.maxPrice || this.maxRange;
                if (min === this.minRange && max === this.maxRange) return 'Price';
                if (max === this.maxRange) return `From ${min.toLocaleString()} AED`;
                return `${min.toLocaleString()} - ${max.toLocaleString()} AED`;
            },

            get minPercent() { 
                return ((this.minPrice - this.minRange) / (this.maxRange - this.minRange)) * 100; 
            },
            
            get maxPercent() { 
                return (((this.maxPrice || this.maxRange) - this.minRange) / (this.maxRange - this.minRange)) * 100; 
            },

            // TOGGLES
            togglePropertyType(type) {
                const slug = this.slugify(type);
                if (this.selectedPropertyTypes.includes(slug)) {
                    this.selectedPropertyTypes = this.selectedPropertyTypes.filter(t => t !== slug);
                } else {
                    this.selectedPropertyTypes.push(slug);
                }
            },

            toggleBedroom(val) {
                if (this.selectedBedrooms.includes(val)) {
                    this.selectedBedrooms = this.selectedBedrooms.filter(b => b !== val);
                } else {
                    this.selectedBedrooms.push(val);
                }
            }
        };
    });
});
