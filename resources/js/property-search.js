document.addEventListener('alpine:init', () => {
    Alpine.data('propertySearch', (config = {}) => {
        // Start with the base location logic
        const base = window.locationSearchLogic(config.initialLocation || '', config.icons || {});
        
        // Add Property Search State
        base.selectedPropertyTypes = config.selectedPropertyTypes || [];
        base.selectedBedrooms = config.selectedBedrooms || [];
        base.minPrice = config.minPrice || 0;
        base.maxPrice = config.maxPrice || 1000000;
        base.minRange = config.minRange || 0;
        base.maxRange = config.maxRange || 1000000;
        base.isModalOpen = false;

        // Wrap the init method
        const originalInit = base.init;
        base.init = function() {
            if (originalInit) originalInit.call(this);
        };

        // Redefine/Override performSearch to include property filters
        base.performSearch = function() {
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
        };

        // Add Toggle Methods
        base.togglePropertyType = function(type) {
            const slug = this.slugify(type);
            if (this.selectedPropertyTypes.includes(slug)) {
                this.selectedPropertyTypes = this.selectedPropertyTypes.filter(t => t !== slug);
            } else {
                this.selectedPropertyTypes.push(slug);
            }
        };

        base.toggleBedroom = function(val) {
            if (this.selectedBedrooms.includes(val)) {
                this.selectedBedrooms = this.selectedBedrooms.filter(b => b !== val);
            } else {
                this.selectedBedrooms.push(val);
            }
        };

        // Define Getters
        Object.defineProperty(base, 'displayPropertyTypes', {
            get() {
                if (this.selectedPropertyTypes.length === 0) return 'Property type';
                return this.selectedPropertyTypes.map(t => 
                    t.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ')
                ).join(', ');
            },
            configurable: true
        });

        Object.defineProperty(base, 'formattedBedrooms', {
            get() {
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
            configurable: true
        });

        Object.defineProperty(base, 'formattedPrice', {
            get() {
                const min = this.minPrice || 0;
                const max = this.maxPrice || this.maxRange;
                if (min === this.minRange && max === this.maxRange) return 'Price';
                if (max === this.maxRange) return `From ${min.toLocaleString()} AED`;
                return `${min.toLocaleString()} - ${max.toLocaleString()} AED`;
            },
            configurable: true
        });

        Object.defineProperty(base, 'minPercent', {
            get() { return ((this.minPrice - this.minRange) / (this.maxRange - this.minRange)) * 100; },
            configurable: true
        });

        Object.defineProperty(base, 'maxPercent', {
            get() { return (((this.maxPrice || this.maxRange) - this.minRange) / (this.maxRange - this.minRange)) * 100; },
            configurable: true
        });

        return base;
    });
});
