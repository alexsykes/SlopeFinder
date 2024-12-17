@props(['active' => false, 'type'=>'a'])

@if($type = 'a')

	<a class="{{ $active ? 'bg-lime-700 text-white': 'bg-lime-900 text-white hover:bg-lime-100 hover:text-lime-900'}} rounded-md px-3 py-2 text-sm font-medium"
	aria-current="{{ $active ? 'page': 'false' }}"
	{{ $attributes }}

>{{ $slot }}</a>
@else
	<button class="{{ $active ? 'bg-gray-900 text-white': 'text-gray-300 hover:bg-gray-700 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium"
	aria-current="{{ $active ? 'page': 'false' }}"
	{{ $attributes }}

>{{ $slot }}</button>

@endif