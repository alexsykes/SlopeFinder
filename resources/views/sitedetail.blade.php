<x-layout>
<x-slot:heading>{{ $site->site_name }}</x-slot:heading>
	<div>{{ $site->site_description }}</div>
	<div><strong>Access:</strong> {{$site->site_access }}</div>
	<div><strong>Wind(s): {{$site->site_wind_directions }}</strong></div>

	<x-button href="/sites/{{ $site->id }}/edit">Edit Site</x-button>
</x-layout>