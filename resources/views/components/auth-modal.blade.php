<div x-data="{
        showModal: false,
        step: 'email',
        email: '',
        emailError: '',
        error: '',
        passwordError: '',
        showPassword: false,
        isLoading: false,
        isResending: false,
        verifyCode: ['', '', '', '', '', ''],
        otpError: '',
        otpSuccessMessage: '',
        resendTimer: 60,
        resendInterval: null,
        resetToken: '',
        passwordConfirmation: '',
        startResendTimer() {
            this.resendTimer = 60;
            clearInterval(this.resendInterval);
            this.resendInterval = setInterval(() => {
                if (this.resendTimer > 0) {
                    this.resendTimer--;
                } else {
                    clearInterval(this.resendInterval);
                }
            }, 1000);
        },
        firstName: '',
        lastName: '',
        password: '',
        showRegisterPassword: false,
        country: '',
        agreeTerms: false,
        registerError: ''
     }"
     x-init="
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('reset_token') && urlParams.has('email')) {
            showModal = true;
            step = 'reset_password';
            resetToken = urlParams.get('reset_token');
            email = urlParams.get('email');
            
            // Clean up the URL for security/cleanliness
            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, cleanUrl);
        }
     "
     @open-auth-modal.window="showModal = true"
     @close-auth-modal.window="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false; showRegisterPassword = false; verifyCode = ['', '', '', '', '', '']; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; password = ''; }, 300)"
     @keydown.escape.window="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false; showRegisterPassword = false; verifyCode = ['', '', '', '', '', '']; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; password = ''; }, 300)"
     x-show="showModal"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
     style="display: none;">

    <div @click.away="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false; verifyCode = ['', '', '', '', '', '']; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; }, 300)"
         class="bg-white rounded-xl shadow-lg w-full max-w-md mx-auto relative overflow-hidden"
         x-show="showModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95">

        <div class="p-8">
            <button x-show="step === 'email'" @click="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false; verifyCode = ['', '', '', '', '', '']; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; }, 300)" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            <button x-show="step === 'verify_email' || step === 'password' || step === 'finish_signup'" @click="step = 'email'; error = ''; passwordError = ''; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; verifyCode = ['', '', '', '', '', '']" class="absolute top-4 left-4 text-gray-400 hover:text-gray-600 z-10">
                 <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Email/Phone Step -->
            <div x-show="step === 'email'">
                <h2 class="text-center text-xl font-medium text-gray-900 mb-6 mt-2">Log in or sign up</h2>
                <div class="space-y-3">
                    <a href="{{ route('auth.google') }}" class="w-full flex items-center justify-center gap-3 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                        <img src="{{ asset('images/google.svg') }}" alt="Google icon" class="h-5 w-5">
                        Continue with Google
                    </a>
                    <button class="w-full flex items-center justify-center gap-3 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 font-medium opacity-50 pointer-events-none cursor-not-allowed transition-colors">
                        <img src="{{ asset('images/facebook.svg') }}" alt="Facebook icon" class="h-5 w-5">
                        Continue with Facebook
                    </button>
                    <button class="w-full flex items-center justify-center gap-3 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 font-medium opacity-50 pointer-events-none cursor-not-allowed transition-colors">
                        <img src="{{ asset('images/apple.svg') }}" alt="Apple icon" class="h-5 w-5">
                        Continue with Apple
                    </button>
                </div>
                <div class="flex items-center my-6"><hr class="flex-grow border-gray-200"><span class="px-3 text-gray-400 text-sm">or</span><hr class="flex-grow border-gray-200"></div>

                <form @submit.prevent="
                    if (email.trim() === '') {
                        emailError = 'Email address is required.';
                    } else {
                        isLoading = true;
                        fetch('{{ route('ajax.check-email') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                            },
                            body: JSON.stringify({ email: email })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.exists) {
                                isLoading = false;
                                step = 'password';
                            } else {
                                // New user, send OTP
                                fetch('{{ route('ajax.send-otp') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'Accept': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                    },
                                    body: JSON.stringify({ email: email })
                                })
                                .then(res => res.json())
                                .then(otpData => {
                                    isLoading = false;
                                    if (otpData.status === 'success') {
                                        step = 'verify_email';
                                        startResendTimer();
                                    } else {
                                        emailError = otpData.message || 'Failed to send verification code.';
                                    }
                                }).catch(err => {
                                    isLoading = false;
                                    emailError = 'An error occurred sending the code. Please try again.';
                                });
                            }
                            error = '';
                            passwordError = '';
                        })
                        .catch(err => {
                            isLoading = false;
                            emailError = 'An error occurred. Please try again.';
                        });
                    }
                ">
                    <div>
                        <label for="email-phone" class="block text-sm font-medium text-gray-700 mb-1.5">Email address or phone number</label>
                        <input x-model="email" @input="emailError = ''" type="text" id="email-phone" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Enter your email or phone">
                        <div x-show="emailError" x-text="emailError" class="text-red-500 text-sm mt-2"></div>
                    </div>
                    <button type="submit" :disabled="isLoading" class="w-full bg-electric-blue text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-3 flex justify-center items-center disabled:opacity-70">
                        <span x-show="!isLoading">Continue</span>
                        <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
                <p class="text-xs text-gray-500 text-center mt-6">By continuing, you agree to our <a href="#" class="text-electric-blue hover:underline">Terms</a> & <a href="#" class="text-electric-blue hover:underline">Privacy Policy</a>.</p>
            </div>

            <!-- Verify Email Step (Sign Up) -->
            <div x-show="step === 'verify_email'" style="display: none;" class="-mt-8 -mx-8 bg-white relative">
                <div class="px-8 py-4 border-b border-gray-100 flex items-center justify-center">
                    <h2 class="text-[16px] font-medium text-[#1e1d1d]">Sign up</h2>
                </div>

                <div class="p-8 pt-6">
                    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Verify your email</h3>
                    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">We sent a 6-digit code to <span class="font-medium text-[#1e1d1d]" x-text="email"></span>.</p>

                    <form @submit.prevent="
                        const code = verifyCode.join('');
                        if (code.length < 6) {
                            otpError = 'Please enter the 6-digit code.';
                            return;
                        }
                        isLoading = true;
                        fetch('{{ route('ajax.verify-otp') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                            },
                            body: JSON.stringify({ email: email, code: code })
                        })
                        .then(res => res.json())
                        .then(data => {
                            isLoading = false;
                            if (data.status === 'success') {
                                step = 'finish_signup';
                            } else {
                                otpError = data.message || 'Invalid code.';
                            }
                        }).catch(err => {
                            isLoading = false;
                            otpError = 'An error occurred verifying the code.';
                        });
                    ">
                        <div>
                            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-3">Verification code</label>
                            <div class="flex items-center gap-2">
                                <template x-for="(code, index) in verifyCode" :key="index">
                                    <div class="flex items-center gap-2">
                                        <input type="text" maxlength="1"
                                               class="otp-input w-[52px] h-[52px] text-center text-[20px] font-medium border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors"
                                               :class="{'bg-[#f2f2f2]': verifyCode[index] !== ''}"
                                               x-model="verifyCode[index]"
                                               @input="
                                                  otpError = '';
                                                  if ($event.target.value.length === 1 && index < 5) {
                                                      let inputs = document.querySelectorAll('.otp-input');
                                                      if (inputs[index + 1]) inputs[index + 1].focus();
                                                  }
                                               "
                                               @keydown.backspace="
                                                  if ($event.target.value.length === 0 && index > 0) {
                                                      let inputs = document.querySelectorAll('.otp-input');
                                                      if (inputs[index - 1]) inputs[index - 1].focus();
                                                  }
                                               "
                                               @paste.prevent="
                                                  otpError = '';
                                                  let paste = ($event.clipboardData || window.clipboardData).getData('text');
                                                  paste = paste.replace(/\D/g, '').substring(0, 6);
                                                  for (let i = 0; i < paste.length; i++) {
                                                      if (index + i < 6) {
                                                          verifyCode[index + i] = paste[i];
                                                      }
                                                  }
                                                  setTimeout(() => {
                                                      let inputs = document.querySelectorAll('.otp-input');
                                                      let focusIndex = Math.min(index + paste.length, 5);
                                                      if (inputs[focusIndex]) inputs[focusIndex].focus();
                                                  }, 10);
                                               "
                                        >
                                        <span x-show="index === 2" class="w-4 text-center text-gray-400">-</span>
                                    </div>
                                </template>
                            </div>
                            <div x-show="otpError || otpSuccessMessage"
                                 x-text="otpError || otpSuccessMessage"
                                 class="text-sm mt-3 font-medium"
                                 :class="otpError ? 'text-red-500' : 'text-green-600'"
                                 style="display: none;"></div>
                        </div>

                        <button type="submit" :disabled="isLoading || isResending"
                                class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-8 flex justify-center items-center disabled:opacity-70"
                                :class="{'opacity-50 pointer-events-none': isResending}">
                            <span x-show="!isLoading">Continue</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>

                    <p class="text-[14px] text-[#464646] text-center mt-6">
                        Didn't receive a code?
                                                <button @click="
                                                    if (resendTimer > 0 || isResending) return;
                                                    otpError = '';
                                                    otpSuccessMessage = '';
                                                    isResending = true;
                                                    fetch('{{ route('ajax.send-otp') }}', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'Accept': 'application/json',
                                                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                                        },
                                                        body: JSON.stringify({ email: email })
                                                    })
                                                    .then(res => res.json())
                                                    .then(data => {
                                                        isResending = false;
                                                        if (data.status === 'success') {
                                                            otpSuccessMessage = 'A new code has been sent!';
                                                            verifyCode = ['', '', '', '', '', ''];
                                                            startResendTimer();
                                                            // Focus the first input after clearing
                                                            setTimeout(() => {
                                                                let inputs = document.querySelectorAll('.otp-input');
                                                                if (inputs[0]) inputs[0].focus();
                                                            }, 10);
                                                        } else {
                                                            otpError = data.message || 'Failed to resend.';
                                                        }
                                                    })
                                                    .catch(err => {
                                                        isResending = false;
                                                        otpError = 'An error occurred while resending the code.';
                                                    });
                                                "
                                                :disabled="resendTimer > 0 || isResending"
                                                class="underline decoration-solid transition-colors relative"
                                                :class="{'text-gray-400 cursor-not-allowed': resendTimer > 0 || isResending, 'text-[#464646] hover:text-black': resendTimer === 0 && !isResending}">
                                                    <span :class="{'opacity-0': isResending && resendTimer === 0}">Resend <span x-show="resendTimer > 0" x-text="`in 0:${resendTimer < 10 ? '0' : ''}${resendTimer}`"></span></span>
                                                    <div x-show="isResending && resendTimer === 0" class="absolute inset-0 flex items-center justify-center">
                                                        <svg class="animate-spin h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                        </svg>
                                                    </div>
                                                </button>                    </p>
                </div>
            </div>

            <!-- Finish Sign Up Step (Profile Setup) -->
            <div x-show="step === 'finish_signup'" style="display: none;" class="-mt-8 -mx-8 bg-white relative">
                <div class="px-8 py-4 border-b border-gray-100 flex items-center justify-center">
                    <h2 class="text-[16px] font-medium text-[#1e1d1d]">Sign up</h2>
                </div>

                <div class="p-8 pt-6">
                    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-1">Set up your profile</h3>
                    <p class="text-[16px] text-[#464646] mb-6 leading-[1.5]">Enter your details to get started</p>

                    <form @submit.prevent="
                        if (!firstName || !lastName || !country || !agreeTerms || !password) {
                            registerError = 'Please fill out all required fields and agree to the terms.';
                            return;
                        }
                        isLoading = true;
                        fetch('{{ route('ajax.register') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                first_name: firstName,
                                last_name: lastName,
                                email: email,
                                country: country,
                                password: password
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            isLoading = false;
                            if (data.status === 'success') {
                                window.location.href = data.redirect;
                            } else {
                                registerError = data.message || 'Registration failed.';
                            }
                        }).catch(err => {
                            isLoading = false;
                            registerError = 'An error occurred during registration.';
                        });
                    ">
                        <div class="space-y-4">
                            <div class="flex gap-4">
                                <div class="flex-1">
                                    <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">First name</label>
                                    <input x-model="firstName" type="text" class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="John" @input="registerError = ''">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">Last name</label>
                                    <input x-model="lastName" type="text" class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="Your last name" @input="registerError = ''">
                                </div>
                            </div>

                            <div>
                                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">Email address</label>
                                <input x-model="email" type="email" readonly class="w-full px-4 py-3 border border-[#e8e8e7] bg-gray-50 rounded-[8px] text-gray-500 cursor-not-allowed outline-none">
                            </div>

                            <div>
                                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">Password</label>
                                <div class="relative">
                                    <input x-model="password" :type="showRegisterPassword ? 'text' : 'password'" class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="Create a password" @input="registerError = ''">
                                    <button type="button" @click="showRegisterPassword = !showRegisterPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg x-show="!showRegisterPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="showRegisterPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21L3 3"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">Country</label>
                                <div class="relative">
                                    <select x-model="country" class="w-full px-4 py-3 pl-10 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors appearance-none bg-white">
                                        <option value="" disabled selected>Select a country</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United States">United States</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-[22px]">
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 space-y-4">
                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center w-5 h-5 mt-0.5">
                                        <input type="checkbox" x-model="agreeTerms" class="peer sr-only">
                                        <div class="w-5 h-5 border border-gray-300 rounded bg-white peer-checked:bg-[#1447d4] peer-checked:border-[#1447d4] transition-colors"></div>
                                        <svg class="absolute w-3.5 h-3.5 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-[14px] text-[#1e1d1d]">I agree to the Terms of Service and Privacy Policy.</span>
                                </label>

                                <label class="flex items-start gap-3 cursor-pointer group">
                                    <div class="relative flex items-center justify-center w-5 h-5 mt-0.5">
                                        <input type="checkbox" class="peer sr-only">
                                        <div class="w-5 h-5 border border-gray-300 rounded bg-white peer-checked:bg-[#1447d4] peer-checked:border-[#1447d4] transition-colors"></div>
                                        <svg class="absolute w-3.5 h-3.5 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <span class="text-[14px] text-[#1e1d1d]">I want to receive updates and offers from HopInHome.</span>
                                </label>
                            </div>
                        </div>

                        <div x-show="registerError" x-text="registerError" class="text-red-500 text-sm mt-4" style="display: none;"></div>

                        <button type="submit" :disabled="isLoading" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-6 flex justify-center items-center disabled:opacity-70">
                            <span x-show="!isLoading">Create account</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Password Step (For Existing Users) -->
            <div x-show="step === 'password'" style="display: none;" class="-mt-8 -mx-8 bg-white relative">
                 <div class="px-8 py-4 border-b border-gray-100 flex items-center justify-center">
                    <h2 class="text-[16px] font-medium text-[#1e1d1d]">Log in</h2>
                </div>

                <div class="p-8 pt-6">
                    <p class="text-[16px] text-[#464646] mb-8">Enter your password to continue to <span class="font-medium text-[#1e1d1d]" x-text="email"></span>.</p>
                    <form @submit.prevent="
                    if ($refs.password.value.trim() === '') {
                        passwordError = 'Password is required.';
                        return;
                    }
                    isLoading = true;
                    error = '';
                    passwordError = '';
                    
                    fetch('/ajax/login', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            email: email,
                            password: $refs.password.value
                        })
                    })
                    .then(response => {
                        if (response.status === 200) {
                            response.json().then(data => {
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                } else {
                                    window.location.reload();
                                }
                            });
                        } else {
                            isLoading = false;
                            response.json().then(data => {
                                if (data.errors) {
                                    if (data.errors.password) {
                                        passwordError = data.errors.password[0];
                                    } else if (data.errors.email) {
                                        error = data.errors.email[0];
                                    }
                                } else {
                                    error = 'An unknown error occurred.';
                                }
                            })
                        }
                    })
                    .catch(err => {
                        isLoading = false;
                        error = 'An error occurred. Please try again.';
                    });
                ">
                        <div>
                            <label for="password"
                                   class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                            <div class="relative">
                                <input x-ref="password" :type="showPassword ? 'text' : 'password'" id="password"
                                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                       placeholder="Your password" @input="passwordError = ''">
                                <button type="button" @click="showPassword = !showPassword"
                                        class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M21 21L3 3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div x-show="passwordError" x-text="passwordError" class="text-red-500 text-sm mt-2"></div>
                        <div x-show="error && !passwordError" x-text="error" class="text-red-500 text-sm mt-2"></div>
                        <button type="submit"
                                :disabled="isLoading"
                                class="w-full bg-electric-blue text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-6 flex justify-center items-center disabled:opacity-70">
                            <span x-show="!isLoading">Log in</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                        <button type="button" @click="
                            isLoading = true;
                            fetch('{{ route('ajax.forgot-password') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                                },
                                body: JSON.stringify({ email: email })
                            })
                            .then(res => res.json())
                            .then(data => {
                                isLoading = false;
                                if (data.status === 'success') {
                                    step = 'forgot_password_sent';
                                } else {
                                    error = data.message || 'Failed to send reset link.';
                                }
                            })
                            .catch(err => {
                                isLoading = false;
                                error = 'An error occurred. Please try again.';
                            });
                        " class="block w-full text-center text-sm text-electric-blue hover:underline mt-6">Forgot password?</button>
                    </form>
                </div>
            </div>

            <!-- Forgot Password Sent Step -->
            <div x-show="step === 'forgot_password_sent'" style="display: none;" class="-mt-8 -mx-8 bg-white relative">
                <div class="px-8 py-4 border-b border-gray-100 flex items-center justify-center">
                    <h2 class="text-[16px] font-medium text-[#1e1d1d]">Forgot password?</h2>
                </div>
                
                <div class="p-8 pt-6">
                    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Check your email</h3>
                    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">We've sent a reset link to your email.</p>

                    <button @click="step = 'password'" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-4">
                        Log In
                    </button>
                </div>
            </div>
            <!-- Reset Password Step -->
            <div x-show="step === 'reset_password'" style="display: none;" class="-mt-8 -mx-8 bg-white relative">
                <div class="px-8 py-4 border-b border-gray-100 flex items-center justify-center">
                    <h2 class="text-[16px] font-medium text-[#1e1d1d]">Reset password</h2>
                    <button @click="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false; showRegisterPassword = false; verifyCode = ['', '', '', '', '', '']; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; password = ''; passwordConfirmation = ''; resetToken = ''; }, 300)" class="absolute left-6 top-4 text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <div class="p-8 pt-6">
                    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-1">Set your new password</h3>
                    <p class="text-[16px] text-[#464646] mb-6 leading-[1.5]">Enter a new password for your account.</p>

                    <form @submit.prevent="
                        if (!password || !passwordConfirmation) {
                            error = 'Both password fields are required.';
                            return;
                        }
                        if (password !== passwordConfirmation) {
                            error = 'Passwords do not match.';
                            return;
                        }
                        isLoading = true;
                        fetch('{{ route('ajax.reset-password') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                token: resetToken,
                                email: email,
                                password: password,
                                password_confirmation: passwordConfirmation
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            isLoading = false;
                            // Laravel's default reset password controller returns different structures based on success/failure
                            if (data.message) {
                                // Success typically redirects, but if it returns JSON:
                                window.location.href = '{{ route('home') }}';
                            } else if (data.errors) {
                                error = Object.values(data.errors)[0][0] || 'Reset failed.';
                            }
                        }).catch(err => {
                            isLoading = false;
                            // Since Laravel redirects on success, a fetch error might just mean it redirected.
                            // Let's just try to reload.
                            window.location.href = '{{ route('home') }}';
                        });
                    ">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">New password</label>
                                <div class="relative">
                                    <input x-model="password" :type="showPassword ? 'text' : 'password'" class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="Enter new password" @input="error = ''">
                                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21L3 3"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">Confirm new password</label>
                                <div class="relative">
                                    <input x-model="passwordConfirmation" :type="showRegisterPassword ? 'text' : 'password'" class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="Enter new password again" @input="error = ''">
                                    <button type="button" @click="showRegisterPassword = !showRegisterPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <svg x-show="!showRegisterPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="showRegisterPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21L3 3"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div x-show="error" x-text="error" class="text-red-500 text-sm mt-4" style="display: none;"></div>

                        <button type="submit" :disabled="isLoading" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-6 flex justify-center items-center disabled:opacity-70">
                            <span x-show="!isLoading">Reset password</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
