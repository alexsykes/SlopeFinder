<x-layout>
<x-slot:heading>Sites</x-slot:heading>
	<ul>
		@foreach ($sites as $site)
			<li class="text-indigo-700">
				<a href="/sitedetail/{{ $site['id'] }}">
					<strong>{{ $site['site_name'] }}</strong></a> :: {{$site['site_wind_directions']}}
				
			</li>
		@endforeach
		</ul>
		<div> 
			{{ $sites->links() }}
</div>
</x-layout>