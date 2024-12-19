<x-layout>

<x-slot:heading>SlopeFinder</x-slot:heading>
	<!--a  href="/sites/create"  class="relative inline-flex items-center px-4 py-2 mb-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-200 hover:text-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add a new site</a -->
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