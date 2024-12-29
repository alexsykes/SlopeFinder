<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full bg-white">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php if (env('APP_NAME') != ''){
            echo env('APP_NAME');
        } ?></title>
</head>
<body class="h-full bg-violet-50">

<header class="bg-violet-800 drop-shadow-md">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8  sm:flex sm:justify-between">
        <h1 class="text-3xl font-bold tracking-tight text-white">{{ $heading }}</h1>
        <div class="hidden md:block">
            <div class="ml-4 flex space-x-4 items-center m-auto px md:ml-6" >
                @guest
                    <x-nav-link href="/login" :active="request()->is('login')">Log In</x-nav-link>
                    <x-nav-link href="/register" :active="request()->is('register')">Register</x-nav-link>
                @endguest

                @auth
                    <form method="POST" action="/logout">
                        @csrf
                        <x-form-button>Log Out</x-form-button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>
<main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
    <hr>
    <x-footer-link>
        <div class="text-center mx-auto text-violet-950">
            <a href="/about" class="inline-block mt-1  hover:underline">About</a>
            <a href="/privacy"  class="inline-block mt-1 mx-3 hover:underline">Privacy Policy</a>
            <a href="/contact"  class="inline-block mt-1 mx-3 hover:underline">Contact</a>
        </div>
    </x-footer-link>
    <div class="text-sm mt-1 text-center text-violet-950">©2025 - SlopFinder UK</div>
</main>

</body>
</html>
