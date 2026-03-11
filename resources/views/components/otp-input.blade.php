@props(['name' => 'otp-input', 'model' => 'verifyCode'])

<div class="flex items-center justify-between p-[14px] border border-[#1447d4] rounded-[8px]" x-id="['otp-inputs']">
    <template x-for="(code, index) in {{ $model }}" :key="index">
        <div class="flex items-center gap-2">
            <input type="text"
                   maxlength="1"
                   :data-index="index"
                   class="{{ $name }} w-[51px] h-[51px] text-center text-[20px] font-medium border border-[#1447d4] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors"
                   :class="{'bg-[#E8E8E7] border-[#E8E8E7]': {{ $model }}[index] !== ''}"
                   x-model="{{ $model }}[index]"
                   @input="
                      otpError = '';
                      if ($event.target.value.length === 1 && index < 5) {
                          $el.closest('.flex').nextElementSibling?.querySelector('input')?.focus();
                      }
                   "
                   @keydown.backspace="
                      if ($event.target.value.length === 0 && index > 0) {
                          $el.closest('.flex').previousElementSibling?.querySelector('input')?.focus();
                      }
                   "
                   @paste.prevent="
                      otpError = '';
                      let paste = ($event.clipboardData || window.clipboardData).getData('text');
                      paste = paste.replace(/\D/g, '').substring(0, 6);
                      for (let i = 0; i < paste.length; i++) {
                          if (index + i < 6) {
                              {{ $model }}[index + i] = paste[i];
                          }
                      }
                      $nextTick(() => {
                          let inputs = $el.closest('.flex').parentElement.querySelectorAll('.{{ $name }}');
                          let focusIndex = Math.min(index + paste.length, 5);
                          if (inputs[focusIndex]) inputs[focusIndex].focus();
                      });
                   "
            >
            <span x-show="index === 2" class="w-4 text-center text-gray-400">-</span>
        </div>
    </template>
</div>
