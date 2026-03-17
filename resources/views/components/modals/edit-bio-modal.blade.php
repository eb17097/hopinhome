@props(['action' => null, 'redirectTo' => null])

<x-modals.layout
    name="edit-bio"
    title="Edit bio"
    maxWidth="560px"
    paddingClass="p-8"
    x-data="{
        show: false,
        bio: {{ json_encode(auth()->user()->bio ?? '') }},
        maxLength: 500,
        get remaining() {
            return this.maxLength - this.bio.length;
        },
        close() {
            this.show = false;
        }
     }"
     @open-edit-bio-modal.window="bio = {{ json_encode(auth()->user()->bio ?? '') }};"
>
    <form action="{{ $action ?? route('profile.update') }}" method="POST">
        @csrf
        @if(!isset($action)) @method('PATCH') @endif
        <input type="hidden" name="redirect_to" value="{{ $redirectTo ?? url()->current() }}">

        <div class="flex justify-between items-end mb-2">
            <label for="bio" class="block text-[16px] font-medium text-[#1e1d1d]">Bio</label>
            <span class="text-[14px] text-[#8c8c8c]" x-text="remaining + ' characters remaining'"></span>
        </div>

        <textarea
            name="bio"
            id="bio"
            x-model="bio"
            maxlength="500"
            rows="6"
            class="w-full px-4 py-4 border border-[#e8e8e7] rounded-[8px] focus:ring-1 focus:ring-[#1447d4] focus:border-[#1447d4] outline-none transition-colors text-[16px] text-[#1e1d1d] leading-[1.5] resize-none"
            placeholder="Tell us about yourself..."
        ></textarea>

        {{-- Suggestion Box --}}
        <div class="mt-6 p-4 bg-[#f9f9f8] rounded-[8px] flex items-start gap-3">
            <img src="{{ asset('images/contact_support_blue.svg') }}" class="w-6 h-6 mt-0.5" alt="Info">
            <p class="text-[14px] leading-[1.5] text-[#464646]">
                <span class="font-medium text-[#1e1d1d]">Suggestion:</span> Share a bit about yourself—where you're from, whether you have any pets, and what you do for a living.
            </p>
        </div>

        {{-- Actions --}}
        <div class="mt-8">
            <button type="submit"
                    class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                Save
            </button>
        </div>
    </form>
</x-modals.layout>
