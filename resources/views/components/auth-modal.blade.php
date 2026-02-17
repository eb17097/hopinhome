<div x-data="{ showAuthModal: false }" @open-auth-modal.window="showAuthModal = true" @close-auth-modal.window="showAuthModal = false" x-show="showAuthModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div @click.away="showAuthModal = false" class="bg-white rounded-[14px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] w-full max-w-md mx-auto p-6 relative">
        <button @click="showAuthModal = false" class="absolute top-4 left-4 text-gray-500 hover:text-gray-700">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h2 class="text-center text-xl font-medium text-gray-900 mb-6">Log in or sign up</h2>

        <div class="space-y-4">
            <button class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                <img src="{{ asset('images/google.svg') }}" alt="Google icon" class="h-5 w-5">
                Continue with Google
            </button>
            <button class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                <img src="{{ asset('images/facebook.svg') }}" alt="Facebook icon" class="h-5 w-5">
                Continue with Facebook
            </button>
            <button class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                <img src="{{ asset('images/apple.svg') }}" alt="Apple icon" class="h-5 w-5">
                Continue with Apple
            </button>
        </div>

        <div class="flex items-center my-6">
            <hr class="flex-grow border-gray-200">
            <span class="px-4 text-gray-400 text-sm">or</span>
            <hr class="flex-grow border-gray-200">
        </div>

        <div>
            <label for="email-phone" class="block text-sm font-medium text-gray-700 mb-2">Email address or phone number</label>
            <input type="text" id="email-phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email or phone">
        </div>

        <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition mt-6">
            Continue
        </button>

        <p class="text-xs text-gray-500 text-center mt-6">
            By continuing, you agree to our <a href="#" class="text-blue-600 hover:underline">Terms</a> & <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
        </p>
    </div>
</div>