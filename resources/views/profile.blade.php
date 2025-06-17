@php
    use App\Models\Seller;
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ Auth::user()->name }}'s Profile</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div id="profile" class="bg-white shadow-sm border-bottom p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Profile Information</h2>
                <div class="text-center flex items-center space-x-4">
                    <form method="GET" action="{{ route('profile.edit') }}">
                        @csrf
                        <button class="text-white flex items-center cursor-pointer bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                            <i class="fas fa-edit mr-1"></i>
                            Edit Profile
                        </button>
                    </form>
                    <form method="GET" action="{{ route('dashboard') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-gray-100 hover:bg-gray-200 cursor-pointer text-gray-700 px-6 py-3 rounded-lg flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Dashboard
                        </button>
                    </form>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1">
                <div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-user text-gray-400 mr-3"></i>
                            <span class="text-gray-900">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-envelope text-gray-400 mr-3"></i>
                            <span class="text-gray-900">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-phone text-gray-400 mr-3"></i>
                            <span class="text-gray-900">{{ Auth::user()->phone ?? 'Not provided' }}</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <div class="flex items center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-map-marker-alt text-gray-400 mr-3"></i>
                            <span class="text-gray-900">{{ Auth::user()->address ?? 'Not provided' }}</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Join Date</label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-calendar text-gray-400 mr-3"></i>
                            <span class="text-gray-900">{{ Auth::user()->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-image text-gray-400 mr-3"></i>
                        @if (Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-84 h-84 rounded-full">
                        @else
                            <span class="text-gray-900">No picture uploaded</span>
                        @endif
                    </div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile Picture</label>                    
                </div>
            </div>
        </div>

        @if (Seller::where('user_id', Auth::user()->id)->exists())
            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Shop Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Shop Name</label>
                        <p class="text-gray-900 font-medium">{{ Seller::where('user_id', Auth::id())->first()->shopname }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Shop Created</label>
                        <p class="text-gray-900">{{ Seller::where('user_id', Auth::id())->first()->created_at->format('M d, Y') }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <p class="text-gray-900">{{ Seller::where('user_id', Auth::id())->first()->description }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-xl p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Shop Actions</h3>
                <form method="GET" action="{{ route('product.list') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                        <i class="fas fa-box mr-2"></i>
                        Manage Products
                    </button>
                </form>
                <form method="GET" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="cursor-pointer bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Order History
                    </button>
                </form>
                <form method="GET" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit" class="cursor-pointer bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition duration-200">
                        <i class="fas fa-edit mr-2"></i>
                        Manage Orders
                    </button>
                </form>
            </div>
        @else
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-8 text-white">
                <div class="text-center">
                    <i class="fas fa-store text-4xl mb-4"></i>
                    <h3 class="text-2xl font-bold mb-2">Start Selling Today!</h3>
                    <p class="text-green-100 mb-6">Let's join with us.</p>
                    <form method="POST" action="{{ route('become.seller') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="bg-white text-green-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                            Request Seller Status
                        </button>
                    </form>
                </div>
            </div>       
        @endif

        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Account Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-gray-500 hover:bg-gray-600 text-white px-4 py-3 rounded-lg flex items-center justify-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
                <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Account
                    </button>
                </form>

                <!-- Temporary -->
                <form method="GET" action="{{ route('orders.seller') }}" >
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-3 rounded-lg flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Manage Orders
                    </button>
                </form>
                <!-- End Temporary -->
                 
            </div>
        </div>
    </body>
</html>