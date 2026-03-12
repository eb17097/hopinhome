@props(['name' => 'otp-input', 'model' => 'verifyCode'])

<div class="flex items-center justify-between p-[14px] border border-[#E8E8E7] rounded-[8px]" x-id="['otp-inputs']">
    @for ($i = 0; $i < 6; $i++)
        @if ($i === 3)
            <div class="w-[14px] h-[2px] bg-gray-400 rounded-full"></div>
        @endif
        <input type="text"
               maxlength="1"
               data-index="{{ $i }}"
               class="{{ $name }} w-[51px] h-[51px] text-center text-[20px] font-medium border border-[#1447d4] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors"
               :class="{'bg-[#E8E8E7] border-[#E8E8E7]': {{ $model }}[{{ $i }}] !== ''}"
               x-model="{{ $model }}[{{ $i }}]"
               @input="
                  otpError = '';
                  if ($event.target.value.length === 1 && {{ $i }} < 5) {
                      $el.parentElement.querySelectorAll('.{{ $name }}')[{{ $i + 1 }}]?.focus();
                  }
               "
               @keydown.backspace="
                  if ($event.target.value.length === 0 && {{ $i }} > 0) {
                      $el.parentElement.querySelectorAll('.{{ $name }}')[{{ $i - 1 }}]?.focus();
                  }
               "
               @paste.prevent="
                  otpError = '';
                  let paste = ($event.clipboardData || window.clipboardData).getData('text');
                  paste = paste.replace(/\D/g, '').substring(0, 6);
                  for (let i = 0; i < paste.length; i++) {
                      if ({{ $i }} + i < 6) {
                          {{ $model }}[{{ $i }} + i] = paste[i];
                      }
                  }
                  $nextTick(() => {
                      let inputs = $el.parentElement.querySelectorAll('.{{ $name }}');
                      let focusIndex = Math.min({{ $i }} + paste.length, 5);
                      if (inputs[focusIndex]) inputs[focusIndex].focus();
                  });
               "
        >
    @endfor
</div>
