@props(['active' => false, 'type'=>'a'])

@if($type = 'a')

	<a class="{{ $active ? 'bg-indigo-300  text-white': 'bg-indigo-900 text-white hover:bg-indigo-100 hover:text-lime-900'}} rounded-md px-3 py-2 text-sm font-medium"
	aria-current="{{ $active ? 'page': 'false' }}"
	{{ $attributes }}

>{{ $slot }}</a>
@else
	<button class="{{ $active ? 'bg-indigo-300 text-white': 'text-indigo-300 hover:bg-indigo-200 hover:text-white'}} rounded-md px-3 py-2 text-sm font-medium"
	aria-current="{{ $active ? 'page': 'false' }}"
	{{ $attributes }}

>{{ $slot }}</button>

@endif