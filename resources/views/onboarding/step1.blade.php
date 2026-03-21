<x-onboarding.layout step="1" x-data="{ selectedRole: '', isLoading: false }">
    <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-2 leading-[1.28]">Let’s get started</h1>
    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">What do you plan to do?</p>

    <!-- Options -->
    <div class="space-y-4 mb-12">
        <!-- Option 1: Rent -->
        <label @click="selectedRole = 'renter'" class="block relative p-5 border rounded-lg cursor-pointer transition-all duration-200"
            :class="selectedRole === 'renter' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white hover:border-[#1447d4]'">
            <input type="radio" name="role_intent" value="renter" class="sr-only" x-model="selectedRole">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.5]">
                        I am looking to <span class="text-[#1447d4]">rent</span>
                    </h3>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">I want to find rental properties.</p>
                </div>
                <div class="relative w-6 h-6 shrink-0 ml-4">
                    <div x-show="selectedRole !== 'renter'" class="w-6 h-6 rounded-full border border-[#e8e8e7]"></div>
                    <img x-show="selectedRole === 'renter'" src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-6 h-6" alt="Selected">
                </div>
            </div>
        </label>

        <!-- Option 2: Agent -->
        <label @click="selectedRole = 'agent'" class="block relative p-5 border rounded-lg cursor-pointer transition-all duration-200"
            :class="selectedRole === 'agent' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white hover:border-[#1447d4]'">
            <input type="radio" name="role_intent" value="agent" class="sr-only" x-model="selectedRole">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.5]">
                        I am a real estate <span class="text-[#1447d4]">agent</span>
                    </h3>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">I want to post property listings as a self employed agent.</p>
                </div>
                <div class="relative w-6 h-6 shrink-0 ml-4">
                    <div x-show="selectedRole !== 'agent'" class="w-6 h-6 rounded-full border border-[#e8e8e7]"></div>
                    <img x-show="selectedRole === 'agent'" src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-6 h-6" alt="Selected">
                </div>
            </div>
        </label>

        <!-- Option 3: Brokerage -->
        <label @click="selectedRole = 'brokerage'" class="block relative p-5 border rounded-lg cursor-pointer transition-all duration-200"
            :class="selectedRole === 'brokerage' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white hover:border-[#1447d4]'">
            <input type="radio" name="role_intent" value="brokerage" class="sr-only" x-model="selectedRole">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.5]">
                        I have a real estate <span class="text-[#1447d4]">brokerage</span>
                    </h3>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">I want my agents to post property listings on behalf of the business.</p>
                </div>
                <div class="relative w-6 h-6 shrink-0 ml-4">
                    <div x-show="selectedRole !== 'brokerage'" class="w-6 h-6 rounded-full border border-[#e8e8e7]"></div>
                    <img x-show="selectedRole === 'brokerage'" src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-6 h-6" alt="Selected">
                </div>
            </div>
        </label>

        <!-- Option 4: Owner -->
        <label @click="selectedRole = 'owner'" class="block relative p-5 border rounded-lg cursor-pointer transition-all duration-200"
            :class="selectedRole === 'owner' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white hover:border-[#1447d4]'">
            <input type="radio" name="role_intent" value="owner" class="sr-only" x-model="selectedRole">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.5]">
                        I am a property <span class="text-[#1447d4]">owner</span>
                    </h3>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">I want to rent out my own property.</p>
                </div>
                <div class="relative w-6 h-6 shrink-0 ml-4">
                    <div x-show="selectedRole !== 'owner'" class="w-6 h-6 rounded-full border border-[#e8e8e7]"></div>
                    <img x-show="selectedRole === 'owner'" src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-6 h-6" alt="Selected">
                </div>
            </div>
        </label>
    </div>

    <x-slot:actions>
        <x-onboarding.step-button
            style="margin-left: auto;"
            @click="
                if (!selectedRole) return;
                isLoading = true;
                fetch('{{ route('onboarding.step1') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ role_intent: selectedRole })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = data.redirect;
                    }
                })
                .catch(err => {
                    isLoading = false;
                    console.error(err);
                })
            "
            :disabled="!selectedRole"
        >
            Next
        </x-onboarding.step-button>
    </x-slot:actions>
</x-onboarding.layout>
