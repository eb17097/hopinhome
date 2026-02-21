@props(['similarListings'])

<div class="bg-[#F9F9F8] py-[96px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-[40px]">
            <h2 class="text-[40px] font-medium text-black tracking-[-0.8px] leading-[1.2]">Explore similar properties</h2>
            <a href="#" class="px-[32px] py-[16px] bg-white rounded-[100px] border border-[#E8E8E7] text-black font-medium text-[16px] leading-[1.2] tracking-[-0.32px] hover:bg-gray-50 transition shadow-sm">
                View more properties like this
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-visible">
        @if($similarListings->isNotEmpty())
            <div 
                x-data="{ 
                    isDown: false, 
                    startX: 0, 
                    scrollLeft: 0,
                    handleMouseDown(e) {
                        this.isDown = true;
                        this.startX = e.pageX - $el.offsetLeft;
                        this.scrollLeft = $el.scrollLeft;
                        $el.classList.add('active');
                    },
                    handleMouseLeave() {
                        this.isDown = false;
                        $el.classList.remove('active');
                    },
                    handleMouseUp() {
                        this.isDown = false;
                        $el.classList.remove('active');
                    },
                    handleMouseMove(e) {
                        if (!this.isDown) return;
                        e.preventDefault();
                        const x = e.pageX - $el.offsetLeft;
                        const walk = (x - this.startX) * 2;
                        $el.scrollLeft = this.scrollLeft - walk;
                    }
                }"
                @mousedown="handleMouseDown($event)"
                @mouseleave="handleMouseLeave()"
                @mouseup="handleMouseUp()"
                @mousemove="handleMouseMove($event)"
                class="flex gap-x-[32px] overflow-x-auto pb-8 no-scrollbar scroll-smooth snap-x snap-mandatory cursor-grab active:cursor-grabbing select-none"
            >
                @foreach($similarListings as $similar)
                    <div class="flex-shrink-0 snap-start">
                        <x-listings.compact-listing-card :listing="$similar" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="max-w-7xl mx-auto">
                <p class="text-gray-500 text-lg">No similar properties found at the moment.</p>
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
</style>
