@props(['listing'])

<div class="grid grid-cols-2 gap-2 mb-8">
    <div class="col-span-1">
        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-full object-cover rounded-l-lg">
    </div>
    <div class="col-span-1 grid grid-rows-2 gap-2">
        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-full object-cover rounded-tr-lg">
        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-full object-cover rounded-br-lg">
    </div>
</div>
