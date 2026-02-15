<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">What features does the property have?</h3>
    <p class="text-base text-gray-600 mt-2">Select all that apply</p>

    <div class="mt-8">
        <h4 class="text-lg font-medium text-black">Features</h4>
<div class="grid grid-cols-2 gap-4 mt-4">
            @foreach($features as $feature)
                <div class="flex items-center">
                    <input type="checkbox" :id="'feature_' + {{ $feature->id }}" :value="{{ $feature->id }}" x-model="formData.features" class="hidden">
                    <div @click="formData.features.includes({{ $feature->id }}) ? formData.features = formData.features.filter(id => id !== {{ $feature->id }}) : formData.features.push({{ $feature->id }})" 
                         :class="{'bg-electric-blue border-electric-blue': formData.features.includes({{ $feature->id }})}"
                         class="w-6 h-6 rounded-md border border-light-gray flex items-center justify-center mr-3 cursor-pointer transition-colors">
                        <img src="{{ asset('images/check.svg') }}" alt="Check" class="h-4 w-4" x-show="formData.features.includes({{ $feature->id }})">
                    </div>
                    <label :for="'feature_' + {{ $feature->id }}" class="text-sm font-medium text-gray-700 cursor-pointer">{{ $feature->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
