<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Accept Invitation | {{ config('app.name', 'HopinHome') }}</title>

    <!-- Fonts -->
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">

    <!-- Scripts/Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#fdfdff] font-['General_Sans',sans-serif] text-[#1e1d1d] antialiased">
    <div class="min-h-screen flex flex-col items-center pt-[60px] px-4" x-data="{ step: 'start' }">
        {{-- Logo --}}
        <div class="mb-[48px]">
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}" alt="HopinHome" class="h-[40px]">
            </a>
        </div>

        {{-- Invitation Card --}}
        <div class="bg-white w-full max-w-[444px] rounded-[14px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] overflow-hidden">
            
            {{-- Step 1: Start / Social Options --}}
            <div x-show="step === 'start'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95">
                <div class="h-[66px] flex items-center justify-center border-b border-[#e8e8e7]">
                    <h1 class="text-[18px] font-medium tracking-[-0.36px]">Log in or sign up</h1>
                </div>

                <div class="p-[24px] pt-[33px]">
                    {{-- Social Auth Buttons --}}
                    <div class="space-y-[16px]">
                        <a href="{{ route('auth.google', ['invitation_email' => $user->email, 'invitation_token' => request()->get('signature')]) }}" 
                           class="flex items-center justify-center gap-[10px] w-full h-[52px] border border-[#e8e8e7] rounded-full hover:bg-gray-50 transition-colors">
                            <img src="{{ asset('images/google_icon.svg') }}" alt="" class="w-[18px] h-[18px]">
                            <span class="text-[16px] font-medium tracking-[-0.48px]">Continue with Google</span>
                        </a>
                        
                        <button class="flex items-center justify-center gap-[10px] w-full h-[52px] border border-[#e8e8e7] rounded-full hover:bg-gray-50 transition-colors">
                            <img src="{{ asset('images/facebook_black.svg') }}" alt="" class="w-[18px] h-[18px]">
                            <span class="text-[16px] font-medium tracking-[-0.48px]">Continue with Facebook</span>
                        </button>

                        <button class="flex items-center justify-center gap-[10px] w-full h-[52px] border border-[#e8e8e7] rounded-full hover:bg-gray-50 transition-colors">
                            <img src="{{ asset('images/apple.svg') }}" alt="" class="w-[18px] h-[18px]">
                            <span class="text-[16px] font-medium tracking-[-0.48px]">Continue with Apple</span>
                        </button>
                    </div>

                    {{-- Divider --}}
                    <div class="relative my-[44px]">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[#e8e8e7]"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white px-[12px] text-[14px] text-[#464646]">or</span>
                        </div>
                    </div>

                    {{-- Email Section --}}
                    <div class="space-y-[24px]">
                        <div>
                            <label class="block text-[14px] font-medium mb-[6px]">Email address</label>
                            <input type="email" 
                                   value="{{ $user->email }}" 
                                   readonly 
                                   class="w-full h-[51px] px-[18px] border border-[#e8e8e7] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] bg-gray-50 text-[#464646] cursor-not-allowed">
                        </div>

                        <button @click="step = 'password'" 
                                class="w-full h-[51px] bg-[#1447d4] text-white rounded-full text-[16px] font-medium tracking-[-0.48px] hover:bg-opacity-90 transition-all">
                            Continue
                        </button>
                    </div>

                    <div class="mt-[32px] text-center text-[14px] text-[#464646] leading-[1.5]">
                        By continuing, you agree to our 
                        <a href="#" class="underline">Terms</a> & 
                        <a href="#" class="underline">Privacy Policy</a>.
                    </div>
                </div>
            </div>

            {{-- Step 2: Set Password --}}
            <div x-show="step === 'password'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95">
                <div class="h-[66px] flex items-center px-[24px] border-b border-[#e8e8e7] relative">
                    <button @click="step = 'start'" class="absolute left-[24px] hover:bg-gray-100 p-1 rounded-full transition-colors">
                        <img src="{{ asset('images/arrow_back_gray.svg') }}" class="w-5 h-5" alt="Back">
                    </button>
                    <h1 class="text-[18px] font-medium tracking-[-0.36px] w-full text-center">Set your password</h1>
                </div>

                <div class="p-[24px] pt-[33px]">
                    <p class="text-[15px] text-[#464646] mb-[24px] leading-[1.5]">
                        Choose a secure password to complete your account setup as an agent for <strong>{{ $user->businessOwner->name ?? 'the team' }}</strong>.
                    </p>

                    <form action="{{ route('invitation.complete') }}" method="POST" class="space-y-[20px]">
                        @csrf
                        <input type="hidden" name="email" value="{{ $user->email }}">
                        <input type="hidden" name="signature" value="{{ request()->get('signature') }}">

                        <div>
                            <label class="block text-[14px] font-medium mb-[6px]">Create password</label>
                            <input type="password" 
                                   name="password" 
                                   required 
                                   placeholder="Min. 8 characters"
                                   class="w-full h-[51px] px-[18px] border border-[#e8e8e7] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-1 focus:ring-[#1447d4]">
                        </div>

                        <div>
                            <label class="block text-[14px] font-medium mb-[6px]">Confirm password</label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   required 
                                   class="w-full h-[51px] px-[18px] border border-[#e8e8e7] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-1 focus:ring-[#1447d4]">
                        </div>

                        @if ($errors->any())
                            <div class="text-red-500 text-[14px]">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <button type="submit" 
                                class="w-full h-[51px] bg-[#1447d4] text-white rounded-full text-[16px] font-medium tracking-[-0.48px] hover:bg-opacity-90 transition-all mt-[8px]">
                            Complete registration
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
