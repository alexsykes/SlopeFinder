<x-layout>
		<x-slot:heading>{{ $site->site_name }}</x-slot:heading>
	<div class="ml-1 flex items-baseline space-x-4 justify-between">
		<a href="/sitelist"
		   class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm border border-gray-300 hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"> « Back </a>
		<x-button href="/sites/{{ $site->id }}/edit"
				  class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-200 hover:text-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" > Edit Site » </x-button>
	</div>
	<div>{{ $site->site_description }}</div>
	<div><strong>Access:</strong> {{$site->site_access }}</div>
	<div><strong>Wind(s): {{$site->site_wind_directions }}</strong></div>


</x-layout>