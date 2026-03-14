@props(['name', 'options' => [], 'selected' => null, 'placeholder' => 'Select option', 'width' => 'w-full', 'height' => 'h-[44px]', 'onchange' => ''])

<div x-data="{
    open: false,
    currentValue: '{{ $selected }}',
    label: '{{ $placeholder }}',
    init() {
        this.$nextTick(() => {
            this.updateLabel();
        });
    },
    updateLabel() {
        const options = this.$refs.options.querySelectorAll('[data-value]');
        let found = false;
        options.forEach(opt => {
            if (String(opt.getAttribute('data-value')) === String(this.currentValue)) {
                this.label = opt.innerText.trim();
                found = true;
            }
        });
        if (!found) this.label = '{{ $placeholder }}';
    },
    select(val) {
        this.currentValue = val;
        this.updateLabel();
        this.open = false;

        // Dispatch event for form submission
        this.$nextTick(() => {
            const input = this.$refs.hiddenInput;
            input.dispatchEvent(new Event('change', { bubbles: true }));
            @if($onchange)
                (function() { {!! $onchange !!} }).apply(input);
            @endif
        });
    }
}"
class="relative {{ $width }}">
    <input type="hidden" name="{{ $name }}" :value="$data.currentValue" x-ref="hiddenInput">

    <button type="button"
            @click="$data.open = !$data.open"
            @click.away="$data.open = false"
            class="flex items-center justify-between w-full {{ $height }} px-[14px] bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-1 focus:ring-electric-blue text-[15px] text-[#1e1d1d] transition-all">
        <span x-text="$data.label" class="truncate"></span>
        <img src="{{ asset('images/chevron.svg') }}"
             class="w-[20px] h-[20px] opacity-60 transition-transform duration-200"
             :class="{ 'rotate-180': $data.open }"
             alt="">
    </button>

    <div x-show="$data.open"
         x-cloak
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute z-[110] w-full mt-1 bg-white border border-light-gray rounded-[6px] shadow-[0px_4px_12px_0px_rgba(0,0,0,0.1)] max-h-[450px] overflow-y-auto scrollbar-hide"
         style="scrollbar-width: none; -ms-overflow-style: none;"
         x-ref="options">
        <div>
            @foreach($options as $val => $text)
                <div @click="select('{{ $val }}')"
                     data-value="{{ $val }}"
                     class="px-[14px] py-[10px] text-[15px] cursor-pointer hover:bg-gray-50 transition-colors"
                     :class="$data.currentValue === '{{ $val }}' ? 'text-electric-blue font-medium bg-blue-50/30' : 'text-[#464646]'">
                    {{ $text }}
                </div>
            @endforeach
        </div>
    </div>
</div>
