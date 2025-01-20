@php

// php artisan config:clear

echo "Hello";
dd(Config::all());
$env = env('GMAP_API');
dd($env);
@endphp