<div x-data="{ showModal: false, step: 'email', email: '', emailError: '', error: '', passwordError: '', showPassword: false }"
     @open-auth-modal.window="showModal = true"
     @close-auth-modal.window="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false }, 300)"
     @keydown.escape.window="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false }, 300)"
     x-show="showModal"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
     style="display: none;">

    <div @click.away="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false }, 300)"
         class="bg-white rounded-xl shadow-lg w-full max-w-md mx-auto relative"
         x-show="showModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95">

        <div class="p-8">
            <button @click="showModal = false; setTimeout(() => { step = 'email'; email = ''; emailError = ''; error = ''; passwordError = ''; showPassword = false }, 300)" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <!-- Email/Phone Step -->
            <div x-show="step === 'email'">
                <h2 class="text-center text-xl font-medium text-gray-900 mb-6">Log in or sign up</h2>
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
                <div>
                    <label for="email-phone" class="block text-sm font-medium text-gray-700 mb-1.5">Email address or phone number</label>
                    <input x-model="email" @input="emailError = ''" type="text" id="email-phone" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Enter your email or phone">
                    <div x-show="emailError" x-text="emailError" class="text-red-500 text-sm mt-2"></div>
                </div>
                <button @click="if (email.trim() === '') { emailError = 'Email address is required.' } else { step = 'password'; error = ''; passwordError = ''; }" class="w-full bg-electric-blue text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-6">Continue</button>
                <p class="text-xs text-gray-500 text-center mt-6">By continuing, you agree to our <a href="#" class="text-electric-blue hover:underline">Terms</a> & <a href="#" class="text-electric-blue hover:underline">Privacy Policy</a>.</p>
            </div>

            <!-- Password Step -->
            <div x-show="step === 'password'" style="display: none;">
                <button @click="step = 'email'; error = ''; passwordError = ''" class="absolute top-4 left-4 text-gray-400 hover:text-gray-600">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <h2 class="text-center text-xl font-medium text-gray-900 mb-2">Log in</h2>
                <p class="text-center text-sm text-gray-500 mb-6">Enter your password to continue.</p>
                <form @submit.prevent="
                    if ($refs.password.value.trim() === '') {
                        passwordError = 'Password is required.';
                        return;
                    }
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
                            window.location.reload();
                        } else {
                            response.json().then(data => {
                                error = ''; // Clear previous general errors
                                passwordError = ''; // Clear previous password errors
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
                ">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <div class="relative">
                            <input x-ref="password" :type="showPassword ? 'text' : 'password'" id="password" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Your password" @input="passwordError = ''">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-gray-600">
                                <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21L3 3"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div x-show="passwordError" x-text="passwordError" class="text-red-500 text-sm mt-2"></div>
                    <div x-show="error && !passwordError" x-text="error" class="text-red-500 text-sm mt-2"></div>
                    <button type="submit" class="w-full bg-electric-blue text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-6">Log in</button>
                    <a href="#" class="block text-center text-sm text-electric-blue hover:underline mt-6">Forgot password?</a>
                </form>
            </div>
        </div>
    </div>
</div>
