@props(['listings'])

<div class="bg-white py-[80px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-[40px] gap-4">
            <div>
                <h2 class="text-[40px] font-medium leading-[1.2] tracking-[-0.8px] text-gray-900 font-['General_Sans',_sans-serif]">
                    Popular homes in <span class="text-[#1447D4]">the UAE</span>
                </h2>
            </div>

            <a href="{{ route('listings.index') }}" class="inline-flex items-center justify-center px-[32px] py-[16px] border border-[#E8E8E7] rounded-full text-[16px] font-medium text-black bg-white hover:bg-gray-50 transition tracking-[-0.32px] shadow-sm font-['General_Sans',_sans-serif]">
                View more properties
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-visible relative group">
        @if($listings->isNotEmpty())
            <div 
                x-ref="carousel"
                x-data="{ 
                    isDown: false, 
                    startX: 0, 
                    scrollLeft: 0,
                    moved: false,
                    handleMouseDown(e) {
                        this.isDown = true;
                        this.moved = false;
                        $el.classList.add('dragging');
                        this.startX = e.pageX - $el.offsetLeft;
                        this.scrollLeft = $el.scrollLeft;
                    },
                    handleMouseLeave() {
                        this.isDown = false;
                        $el.classList.remove('dragging');
                    },
                    handleMouseUp(e) {
                        this.isDown = false;
                        $el.classList.remove('dragging');
                        if (this.moved) {
                            e.preventDefault();
                        }
                    },
                    handleMouseMove(e) {
                        if (!this.isDown) return;
                        const x = e.pageX - $el.offsetLeft;
                        const walk = (x - this.startX) * 1.5;
                        if (Math.abs(walk) > 5) {
                            this.moved = true;
                        }
                        $el.scrollLeft = this.scrollLeft - walk;
                    },
                    handleChildClick(e) {
                        if (this.moved) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                        }
                    }
                }"
                @mousedown="handleMouseDown($event)"
                @mouseleave="handleMouseLeave()"
                @mouseup="handleMouseUp($event)"
                @mousemove="handleMouseMove($event)"
                @click.capture="handleChildClick($event)"
                class="carousel-container flex gap-x-[32px] overflow-x-auto pb-8 no-scrollbar scroll-smooth snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none"
            >
                @foreach($listings as $listing)
                    <div class="flex-shrink-0 snap-start" draggable="false">
                        <x-listings.compact-listing-card :listing="$listing" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-7xl mx-auto">
                <p class="text-gray-500 text-lg">No properties found at the moment.</p>
            </div>
        @endif
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .carousel-container.dragging {
        scroll-snap-type: none;
        scroll-behavior: auto;
    }
</style>
