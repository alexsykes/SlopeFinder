<x-layout>
	<x-slot:heading>Site Directory</x-slot:heading>
	<div id="site_container" class="columns-3xs">
		<div>
			@foreach ($sites as $site)
				<div class="text-sm text-black">
					<a href="/sitedetail/{{ $site['id'] }}">
						<strong>{{ $site['site_name'] }}</strong></a> :: {{$site['site_wind_directions']}}

				</div>
			@endforeach
		</div></div>
	<div>
		{{ $sites->links() }}
	</div>
</x-layout>
