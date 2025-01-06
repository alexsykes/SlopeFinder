<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full bg-violet-800">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if (env('APP_NAME') != ''){
            echo env('APP_NAME');
        } ?></title>



</head>
<body class="h-full bg-violet-950 text-white">

<header class="bg-violet-800 drop-shadow-md">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8  sm:flex sm:justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-white">{{ $heading }}</h1>
        <div class="hidden md:block">
            <div class="ml-4 flex space-x-4 items-center m-auto px md:ml-6" >
                <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                @guest
                    <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                    <!-- x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link -->
                @endguest

                @auth
                        <!--x-nav-link href="/club/register" :active="request()->is('club/register')">Add a club</x-nav-link -->
                        <x-nav-link href="/auth/profile" :active="request()->is('auth/profile')">Me</x-nav-link>
                    <form method="POST" action="/logout">
                        @csrf
                        <x-form-button>Log Out</x-form-button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>
<main class="bg-white text-black">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
    <hr>
    <div class = "bg-violet-950 text-white">
    <x-footer-link>
        <div class="text-center mx-auto  text-white">
            <a href="/about" class="inline-block mt-1 mx-3 hover:underline">About</a>
            <a href="/terms" class="inline-block mt-1 mx-3 hover:underline">Terms and Conditions</a>
            <a href="/clublist" class="inline-block mt-1 mx-3 hover:underline">Clubs</a>
            @auth
            <a href="/sitelist" class="inline-block mt-1 mx-3 hover:underline">Site Directory</a>
            @endauth
            <a href="/privacy"  class="inline-block mt-1 mx-3 hover:underline">Privacy Policy</a>
            <a href="/contact"  class="inline-block mt-1 mx-3 hover:underline">Contact</a>
        </div>
    </x-footer-link>
    <div class="text-sm mt-1 text-center bg-violet-950 text-white">©2025 - SlopeFinder UK</div></div>
</main>
</body>
</html>
