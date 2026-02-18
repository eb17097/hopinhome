<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">What features does the property have?</h3>
    <p class="text-[16px] text-[#464646] mb-8">Select all that apply.</p>

    <div class="mt-8">
        <div class="flex items-center gap-2 mb-6">
            <h4 class="text-[18px] font-medium text-[#1e1d1d]">Features</h4>
            <div class="w-5 h-5 bg-[#1447d4] rounded-full flex items-center justify-center">
                <span class="text-[12px] font-medium text-white" x-text="formData.features.length">0</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-12">
            @foreach($features as $feature)
                <div class="flex items-center">
                    <input type="checkbox" :id="'feature_' + {{ $feature->id }}" :value="{{ $feature->id }}" x-model="formData.features" class="hidden">
                    <div @click="formData.features.includes({{ $feature->id }}) ? formData.features = formData.features.filter(id => id !== {{ $feature->id }}) : formData.features.push({{ $feature->id }})" 
                         :class="{
                            'bg-[#1447d4] border-[#1447d4]': formData.features.includes({{ $feature->id }}),
                            'bg-white border-[#e8e8e7]': !formData.features.includes({{ $feature->id }})
                         }"
                         class="w-6 h-6 rounded-[4px] border flex items-center justify-center mr-3 cursor-pointer transition-all hover:border-[#1447d4]">
                        <img src="{{ asset('images/check.svg') }}" alt="Check" class="w-4 h-4 brightness-0 invert" x-show="formData.features.includes({{ $feature->id }})">
                    </div>
                    <label @click="formData.features.includes({{ $feature->id }}) ? formData.features = formData.features.filter(id => id !== {{ $feature->id }}) : formData.features.push({{ $feature->id }})" 
                           class="text-[16px] text-[#464646] cursor-pointer hover:text-[#1e1d1d] transition-colors">
                        {{ $feature->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>