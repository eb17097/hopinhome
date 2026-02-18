<div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-light-gray flex justify-between items-center">
        <h3 class="text-[18px] font-medium text-[#1e1d1d]">My listings</h3>
        <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow Forward" class="w-[18px] h-[18px] brightness-0 opacity-70">
    </div>

    {{-- Content --}}
    <div class="flex flex-col items-center justify-center py-[100px] px-6">
        <h3 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-4 text-center leading-[1.28]">You have no listings yet</h3>
        <p class="text-[16px] text-[#464646] mb-8 text-center leading-[1.5]">
            Once you create a listing, it will appear here.
        </p>
        <a href="{{ route('listings.create') }}" class="bg-electric-blue text-white font-medium px-10 py-4 rounded-[6px] flex items-center space-x-2 hover:opacity-90 transition text-[16px]">
            <img alt="add" class="h-4 w-4 brightness-0 invert" src="{{ asset('images/add.svg') }}">
            <span>Create a listing</span>
        </a>
    </div>
</div>