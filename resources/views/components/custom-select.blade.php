@props(['name', 'options' => [], 'selected' => null, 'placeholder' => 'Select option', 'width' => 'w-full', 'height' => 'h-[44px]', 'onchange' => ''])

<div x-data="{ 
    open: false, 
    value: '{{ $selected }}',
    label: '{{ $placeholder }}',
    init() {
        this.$nextTick(() => {
            this.updateLabel();
        });
    },
    updateLabel() {
        const option = this.$refs.options.querySelector(`[data-value='${this.value}']`);
        if (option) {
            this.label = option.innerText.trim();
        } else if ('{{ $selected }}' && this.$refs.options.querySelector(`[data-value='{{ $selected }}']`)) {
             const initialOption = this.$refs.options.querySelector(`[data-value='{{ $selected }}']`);
             this.label = initialOption.innerText.trim();
        }
    },
    select(val) {
        this.value = val;
        this.updateLabel();
        this.open = false;
        
        // Dispatch event for form submission
        this.$nextTick(() => {
            const select = this.$refs.hiddenInput;
            select.dispatchEvent(new Event('change', { bubbles: true }));
            {{ $onchange }}
        });
    }
}" 
class="relative {{ $width }}">
    <input type="hidden" name="{{ $name }}" x-model="value" x-ref="hiddenInput">
    
    <button type="button" 
            @click="open = !open"
            @click.away="open = false"
            class="flex items-center justify-between w-full {{ $height }} px-[14px] bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-1 focus:ring-electric-blue text-[15px] text-[#1e1d1d] transition-all">
        <span x-text="label" class="truncate"></span>
        <img src="{{ asset('images/chevron.svg') }}" 
             class="w-[20px] h-[20px] opacity-60 transition-transform duration-200" 
             :class="{ 'rotate-180': open }" 
             alt="">
    </button>

    <div x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-[110] w-full mt-1 bg-white border border-light-gray rounded-[6px] shadow-[0px_4px_12px_0px_rgba(0,0,0,0.1)] max-h-[250px] overflow-y-auto scrollbar-hide"
         style="scrollbar-width: none; -ms-overflow-style: none;"
         x-ref="options">
        <div class="py-1">
            @foreach($options as $val => $text)
                <div @click="select('{{ $val }}')" 
                     data-value="{{ $val }}"
                     class="px-[14px] py-[10px] text-[15px] cursor-pointer hover:bg-gray-50 transition-colors"
                     :class="{ 'text-electric-blue font-medium bg-blue-50/30': value === '{{ $val }}', 'text-[#464646]': value !== '{{ $val }}' }">
                    {{ $text }}
                </div>
            @endforeach
        </div>
    </div>
</div>
