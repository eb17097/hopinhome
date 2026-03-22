<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>You're invited | {{ config('app.name', 'HopinHome') }}</title>

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
            <div class="p-[24px] pt-[40px] flex flex-col items-center text-center">
                {{-- Icon --}}
                <div class="w-[64px] h-[64px] bg-[#f0f4ff] rounded-full flex items-center justify-center mb-[24px]">
                    <img src="{{ asset('images/mail_blue.svg') }}" class="w-[32px] h-[32px]" alt="">
                </div>

                {{-- Heading --}}
                <h1 class="text-[24px] font-medium tracking-[-0.48px] leading-[1.28] mb-[16px]">
                    {{ $user->businessOwner->name ?? 'Mohammad' }} has invited You<br>to join this business
                </h1>

                {{-- Business Card (Static) --}}
                <div class="bg-[#04247B] rounded-[6px] p-[14px] flex items-center space-x-[12px] mb-[24px] text-left">
                    <div class="w-[40px] h-[40px] rounded-[4px] bg-white/10 flex items-center justify-center shrink-0 overflow-hidden">
                        <img src="{{ asset('images/apartment_blue.svg') }}" class="w-[24px] h-[24px] brightness-0 invert" alt="">
                    </div>
                    <div>
                        <div class="text-[16px] font-medium text-white leading-[1.3]">Azure Crescent Realty</div>
                        <div class="text-[12px] text-white leading-[1.5]">16 agents • 560 active listings</div>
                    </div>
                </div>

                {{-- Description --}}
                <p class="text-[16px] text-[#464646] leading-[1.5] mb-[40px]">
                    Join to create listings and find tenants as a property manager within this business.
                </p>

                {{-- Actions --}}
                <div class="w-full space-y-[16px]">
                    <form action="{{ route('invitation.finalize') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full h-[51px] bg-[#1447d4] text-white rounded-full text-[16px] font-medium tracking-[-0.48px] hover:bg-opacity-90 transition-all">
                            Accept invitation
                        </button>
                    </form>

                    <a href="#" class="block text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                        Decline invitation
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
