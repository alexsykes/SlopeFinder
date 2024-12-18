<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php if (env('APP_NAME') != ''){

echo env('APP_NAME');

} ?></title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
  <body class="h-full bg-white">
<div class="min-h-full">
  <nav class="bg-lime-400">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">

          <div class="hidden md:block">
				<div class="ml-10 flex items-baseline space-x-4">
					<!--x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link -->
					<x-nav-link href="/sitelist" :active="request()->is('sitelist')">Site list</x-nav-link>
                    <x-nav-link href="/sites/create" :active="request()->is('sites/create')">Add a Site</x-nav-link>
                    <x-nav-link href="/login" :active="request()->is('login')">Login</x-nav-link>
				</div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <header class="bg-lime-100 shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $heading }}</h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      {{ $slot }}
    </div>
  </main>
</div>
</body>
</html>
