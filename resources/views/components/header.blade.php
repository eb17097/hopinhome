<nav class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-22 py-4">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img src="http://localhost:3845/assets/42353c0345cb2111d061b3f456dce6e2d57c847a.svg" alt="Logo" class="h-8">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-lg font-medium text-gray-900 hover:text-blue-600 transition">Home</a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-lg font-medium text-gray-500 hover:text-blue-600 transition">
                        <span>Find Properties</span>
                        <img src="http://localhost:3845/assets/400a9c2ac0844d7cf156ce4903b9b84b765d8c16.svg" class="w-5 h-5 ml-1 transform" :class="{'rotate-180': open}" alt="arrow">
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg" style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Sale</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Rent</a>
                    </div>
                </div>
                
                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">Articles & Insights</a>
                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">About Us</a>
            </div>

            <div class="flex items-center space-x-4">
                <button>
                    <img src="http://localhost:3845/assets/d749178c561229b7088927e583414f88261b965b.svg" alt="Language" class="w-6 h-6">
                </button>
                <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                    Log in or sign up
                </a>
            </div>
        </div>
    </div>
</nav>
