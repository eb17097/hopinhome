@props(['name' => 'add-agent'])

<x-modals.layout
    :name="$name"
    title="Add an agent"
    maxWidth="444px"
    paddingClass="pt-[24px] pb-[32px] px-[24px]"
    x-data="{
        show: false,
        fullName: '',
        email: '',
        licenseNumber: '',
        listingLimit: '50',
        boostLimit: '10',

        close() {
            this.show = false;
        }
    }"
>
    <div>
        {{-- Available Seats --}}
        <div class="bg-[#f9f9f8] rounded-[6px] p-[14px] flex justify-between items-center mb-[24px]">
            <span class="text-[16px] text-[#1e1d1d] font-normal">Available seats</span>
            <div class="flex items-center space-x-1.5">
                <span class="text-[20px] font-medium text-[#1e1d1d]">5</span>
                <img src="{{ asset('images/group.svg') }}" class="w-5 h-5 brightness-0" alt="">
            </div>
        </div>

        {{-- Form Fields --}}
        <div class="space-y-[16px] mb-[24px]">
            <div>
                <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Full name</label>
                <input type="text" x-model="fullName" placeholder="Enter agent's full name" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue placeholder:text-[#464646]">
            </div>

            <div>
                <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Email address</label>
                <input type="email" x-model="email" placeholder="agent@example.com" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue placeholder:text-[#464646]">
            </div>

            <div>
                <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Agent license number</label>
                <input type="text" x-model="licenseNumber" placeholder="Enter license number" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue placeholder:text-[#464646]">
            </div>

            <div class="flex gap-[16px]">
                <div class="flex-1">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Listing credit limit</label>
                    <input type="number" x-model="listingLimit" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue">
                </div>
                <div class="flex-1">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Boost credit limit</label>
                    <input type="number" x-model="boostLimit" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue">
                </div>
            </div>
        </div>

        {{-- Info Box --}}
        <div class="bg-[#f9f9f8] rounded-[6px] p-[14px] flex items-start space-x-3 mb-[24px]">
            <img src="{{ asset('images/contact_support_blue.svg') }}" class="w-5 h-5 mt-0.5 shrink-0" alt="">
            <p class="text-[14px] leading-[1.5] text-[#464646]">
                Credit limits <span class="font-bold text-[#1e1d1d]">reset</span> every billing cycle. Unused credits do not roll over to the next month
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col space-y-4">
            <button class="w-full h-[51px] bg-electric-blue text-white rounded-[50px] text-[16px] font-medium hover:opacity-90 transition-opacity">
                Send invite
            </button>
            <button @click="close()" class="text-[15px] text-[#464646] font-medium hover:text-[#1e1d1d] transition-colors">
                Cancel
            </button>
        </div>
    </div>
</x-modals.layout>
