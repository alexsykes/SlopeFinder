<x-layout>
	<div class="flex justify-between">
		<x-slot:heading>{{ $site->site_name }}</x-slot:heading>
		<x-button href="/sites/{{ $site->id }}/edit">Edit Site</x-button>
	</div>
	<div>{{ $site->site_description }}</div>
	<div><strong>Access:</strong> {{$site->site_access }}</div>
	<div><strong>Wind(s): {{$site->site_wind_directions }}</strong></div>


</x-layout>