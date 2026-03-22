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
    <div class="min-h-screen flex flex-col items-center pt-[60px] px-4">
        {{-- Logo --}}
        <div class="mb-[48px]">
            <a href="/">
                <img src="{{ asset('images/logo.svg') }}" alt="HopinHome" class="h-[40px]">
            </a>
        </div>

        {{-- Invitation Card --}}
        <div class="bg-white w-full max-w-[444px] rounded-[14px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] overflow-hidden">
            {{-- Card Header --}}
            <div class="h-[66px] flex items-center justify-center border-b border-[#e8e8e7]">
                <h1 class="text-[18px] font-medium tracking-[-0.36px]">Log in or sign up</h1>
            </div>

            <div class="p-[24px] pt-[33px]">
                {{-- Social Auth Buttons --}}
                <div class="space-y-[16px]">
                    <a href="{{ route('auth.google', ['invitation_token' => request()->get('signature')]) }}" 
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

                {{-- Email Form --}}
                <form action="#" method="POST" class="space-y-[24px]">
                    @csrf
                    <div>
                        <label class="block text-[14px] font-medium mb-[6px]">Email address</label>
                        <input type="email" 
                               value="{{ $user->email }}" 
                               readonly 
                               class="w-full h-[51px] px-[18px] border border-[#e8e8e7] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] bg-gray-50 text-[#464646] cursor-not-allowed focus:outline-none">
                        <p class="mt-2 text-[12px] text-[#464646]">This email address has been invited by the team owner.</p>
                    </div>

                    <button type="submit" 
                            class="w-full h-[51px] bg-[#1447d4] text-white rounded-full text-[16px] font-medium tracking-[-0.48px] hover:bg-opacity-90 transition-all">
                        Continue
                    </button>
                </form>

                {{-- Footer Text --}}
                <div class="mt-[32px] text-center text-[14px] text-[#464646] leading-[1.5]">
                    By continuing, you agree to our 
                    <a href="#" class="underline">Terms</a> & 
                    <a href="#" class="underline">Privacy Policy</a>.
                </div>
            </div>
        </div>
    </div>
</body>
</html>
