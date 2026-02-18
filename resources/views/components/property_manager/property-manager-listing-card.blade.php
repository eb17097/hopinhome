@props(['listing'])

<div x-data="{ showDeleteModal: false }" class="bg-white border border-light-gray rounded-lg shadow-sm">
    @if($listing->is_boosted)
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white text-sm px-4 py-2 rounded-t-lg flex items-center space-x-2">
        <img src="{{ asset('images/bolt.svg') }}" alt="Boosted" class="h-4 w-4">
        <span>10x boosted for 3 more days</span>
    </div>
    @endif

    <div class="p-4">
        <div class="flex items-start space-x-4">
            <a href="{{ route('listings.show', $listing->id) }}" class="flex items-start space-x-4 group">
                <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder_image_1.png') }}" alt="{{ $listing->name }}" class="w-20 h-20 object-cover rounded-md group-hover:opacity-75 transition-opacity">
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-black group-hover:text-electric-blue transition-colors">{{ $listing->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $listing->address }}</p>
                        </div>
                    </div>
                </div>
            </a>
            <button class="flex-shrink-0">
                <svg class="w-6 h-6 text-gray-500 hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
        </div>

        <hr class="my-4">

        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4 text-sm text-gray-600">
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/visibility.svg') }}" alt="Views" class="h-4 w-4">
                    <span>{{ $listing->views ?? 0 }}</span>
                </div>
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/chat_light.svg') }}" alt="Messages" class="h-4 w-4">
                    <span>{{ $listing->messages ?? 0 }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('listings.show', $listing->id) }}" class="text-sm font-medium text-electric-blue hover:underline">View</a>
                <a href="#" class="text-sm font-medium text-gray-700 hover:underline">Edit</a>
                
                <form x-on:submit.prevent="showDeleteModal = true" method="POST" action="{{ route('listings.destroy', $listing->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-sm font-medium text-red-600 hover:underline">Delete</button>
                </form>

                @if($listing->status === 'Active')
                    <span class="bg-like-green text-white text-xs font-medium px-3 py-1 rounded-full flex items-center space-x-1">
                        <img src="{{ asset('images/checkmark.svg') }}" alt="Active" class="h-3 w-3">
                        <span>Active</span>
                    </span>
                @elseif($listing->status === 'In review')
                    <span class="bg-yellow-400 text-black text-xs font-medium px-3 py-1 rounded-full">In review</span>
                @elseif($listing->status === 'Declined')
                    <span class="bg-red-500 text-white text-xs font-medium px-3 py-1 rounded-full">Declined</span>
                @else
                    <span class="bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">{{ $listing->status }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="showDeleteModal" @click.away="showDeleteModal = false"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="showDeleteModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Delete Listing
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this listing? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <form method="POST" action="{{ route('listings.destroy', $listing->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                            Delete
                        </button>
                    </form>
                    <button @click="showDeleteModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

