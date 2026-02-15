<div class="h-[228px] relative w-[277px]">
    <div class="absolute bg-off-white inset-[0_0_78.95%_0] rounded-[4px]"></div>
    <div class="absolute content-stretch flex gap-[10px] h-[24px] items-center left-[5.78%] right-[5.78%] top-[calc(50%-90px)]">
        <p class="flex-[1_0_0] font-medium leading-[1.5] text-[16px] text-black">
            My profile
        </p>
        <a href="{{ route('profile.edit') }}" class="block cursor-pointer relative shrink-0 size-[18px]">
            <img alt="arrow forward" class="block max-w-none size-full" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
    </div>
    <div class="absolute content-stretch flex gap-[10px] h-[24px] items-center left-[5.78%] right-[5.78%] top-[calc(50%-42px)]">
        <p class="flex-[1_0_0] font-medium leading-[1.5] text-[16px] text-black">
            Notification preferences
        </p>
        <button class="block cursor-pointer relative shrink-0 size-[18px]">
            <img alt="arrow forward" class="block max-w-none size-full" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
    </div>
    <div class="absolute content-stretch flex gap-[10px] h-[24px] items-center left-[5.78%] right-[5.78%] top-[calc(50%+6px)]">
        <p class="flex-[1_0_0] font-medium leading-[1.5] text-[16px] text-black">
            Regional preferences
        </p>
        <button class="block cursor-pointer relative shrink-0 size-[18px]">
            <img alt="arrow forward" class="block max-w-none size-full" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
    </div>
    <div class="absolute content-stretch flex gap-[10px] h-[24px] items-center left-[5.78%] right-[5.78%] top-[calc(50%+54px)]">
        <p class="flex-[1_0_0] font-medium leading-[1.5] text-[16px] text-black">
            Account security
        </p>
        <button class="block cursor-pointer relative shrink-0 size-[18px]">
            <img alt="arrow forward" class="block max-w-none size-full" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
    </div>
    <div class="absolute content-stretch flex gap-[10px] h-[24px] items-center left-[5.78%] right-[5.78%] top-[calc(50%+102px)]">
        <p class="flex-[1_0_0] font-medium leading-[1.5] text-[16px] text-red-600">
            Sign out
        </p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="block cursor-pointer relative shrink-0 size-[18px]">
                <img alt="arrow forward" class="block max-w-none size-full" src="{{ asset('images/arrow_forward_red.svg') }}">
            </button>
        </form>
    </div>
</div>
