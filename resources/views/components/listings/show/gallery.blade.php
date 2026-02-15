@props(['listing'])

<div class="mt-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <div class="col-span-1">
            <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder_image_1.png') }}" alt="{{ $listing->name }}" class="w-full h-[500px] object-cover rounded-tl-lg rounded-bl-lg">
        </div>
        <div class="col-span-1 grid grid-cols-2 gap-2">
            @foreach($listing->images->slice(1, 4) as $image)
                <img src="{{ $image->image_url }}" alt="{{ $listing->name }}" class="w-full h-[246px] object-cover 
                    @if($loop->first) rounded-tr-lg @endif
                    @if($loop->count > 2 && $loop->iteration === 2) rounded-tr-lg @endif
                    @if($loop->iteration === $loop->count) rounded-br-lg @endif
                ">
            @endforeach
        </div>
    </div>
</div>
