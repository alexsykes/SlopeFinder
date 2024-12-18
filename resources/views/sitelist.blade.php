<x-layout>
<x-slot:heading>Site list page</x-slot:heading>
	<h1>Site list</h1>
	<ul>
		@foreach ($sites as $site)
			<li class="text-lime-500">
				<a href="/sitedetail/{{ $site['id'] }}">
					<strong>{{ $site['site_name'] }}</strong></a> :: {{$site['site_wind_directions']}}
				
			</li>
		@endforeach
		</ul>
		<div> 
			{{ $sites->links() }}
</div>
</x-layout>