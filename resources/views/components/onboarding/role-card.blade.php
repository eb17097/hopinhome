@props(['value', 'title', 'highlight', 'description'])

<label @click="data.role_intent = '{{ $value }}'" 
    class="h-[84px] w-[560px] block relative p-[18px] border rounded-[6px] cursor-pointer transition-all duration-200"
    :class="data.role_intent === '{{ $value }}' ? 'border-[#1447d4] bg-white shadow-[0_2px_10px_0_rgba(0,0,0,0.10)]' : 'border-[#e8e8e7] bg-white hover:border-[#1447d4]'">
    <input type="radio" name="role_intent" value="{{ $value }}" class="sr-only" x-model="data.role_intent">
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.5]">
                {{ $title }} <span class="text-[#1447d4]">{{ $highlight }}</span>
            </h3>
            <p class="text-[14px] text-[#464646] leading-[1.5]">{{ $description }}</p>
        </div>
        <div class="relative w-6 h-6 shrink-0 ml-4">
            <div x-show="data.role_intent !== '{{ $value }}'" class="w-6 h-6 rounded-full border border-[#e8e8e7]"></div>
            <img x-show="data.role_intent === '{{ $value }}'" src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-6 h-6" alt="Selected">
        </div>
    </div>
</label>
