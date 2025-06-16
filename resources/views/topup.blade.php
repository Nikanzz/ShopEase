<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ Auth::user()->name }}'s Profile</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="container flex mx-auto px-4 py-8 justify-between">
            <h2 class="text-xl font-semibold mb-4">Saldo Anda: {{ Auth::user()->balance }}</h2>
            <form method="GET" action="{{ route('dashboard') }}">
                @csrf
                <button type="submit" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition duration-200">
                    Kembali ke Dashboard
                </button>
            </form>
        </div>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-4">Top Up Saldo</h1>

            <form action="{{ route('topup.process') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700">Jumlah Top Up</label>
                    <input type="number" name="amount" id="amount" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <button type="submit" 
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Top Up
                </button>
            </form>
        </div>
    </body>
</html>