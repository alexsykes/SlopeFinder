@props(['active' => false, 'type'=>'a'])

<footer class="flex flex-wrap flex-col items-center px-4 py-6 text-sm text-gray-700 border-t">
   <div class="{{ $active ? ' text-violet-400': ' text-violet-950 hover:bg-violet-2 hover:text-violet-300'}} rounded-md  text-sm font-light"
       aria-current="{{ $active ? 'page': 'false' }}"
            {{ $attributes }} >{{ $slot }}
   </div>
</footer>