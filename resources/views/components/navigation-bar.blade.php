<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-5">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <div class="bg-orange-500 text-white font-bold text-xl px-3 py-2 rounded">
                    <a href="{{ route('dashboard') }}">ShopEase</a>
                </div>
            </div>

            <!-- Search bar -->
            <div class="flex-1 max-w-2xl mx-8">
                <form method="GET" class="relative">
                    <div class="flex">
                        <input 
                            type="text" 
                            name="q" 
                            value="{{ request('q') }}"
                            placeholder="Search products, brands and categories..."
                            class="flex-1 px-4 py-3 border-2 border-orange-500 rounded-l-md focus:outline-none focus:border-orange-600">
                        <button 
                            type="submit" 
                            class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-r-md transition duration-200">
                            <i data-lucide='search'></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Cart and User Menu -->
             <div>          
                @auth
                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 hover:text-orange-500 focus:outline-none">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                <i class="w-4 h-4"></i>
                            </div>
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <i class="w-4 h-4"></i>
                        </button>

                        <div class="absolute right-0 top-full w-48 bg-white rounded-md shadow-lg border group-hover:block hidden hover:block">
                            <div class="py-2">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i data-lucide="user" class="w-4 h-4 inline mr-2"></i>My Profile
                                </a>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i data-lucide="wallet" class="w-4 h-4 inline mr-2"></i>My Balance
                                </a>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i data-lucide="package" class="w-4 h-4 inline mr-2"></i>My Orders
                                </a>
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i data-lucide="star" class="w-4 h-4 inline mr-2"></i>My Reviews
                                </a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i data-lucide="log-out" class="w-4 h-4 inline mr-2"></i>Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Login/Register -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-orange-500">Login</a>
                        <a href="{{ route('register') }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Sign Up</a>
                    </div>
                @endauth
            </div>
            <a href="{{ route('dashboard') }}" class="relative group">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-gray-900 group-hover:text-orange-500"></i> 
            </a>
        </div>
    </div>
</nav>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>