<x-layout>
	<style>
		#map {
			height: 600px;
			width: 100%;
		}
	</style>
	<script>
		(g=>{
			let h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__",
					m = document, b = window;b=b[c]||(b[c]={});
			let d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
					u = () => h || (h = new Promise(async (f, n) => {
						await (a = m.createElement("script"));
						e.set("libraries", [...r] + "");
						for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
						e.set("callback", c + ".maps." + q);
						a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
						d[q] = f;
						a.onerror = () => h = n(Error(p + " could not load."));
						a.nonce = m.querySelector("script[nonce]")?.nonce || "";
						m.head.append(a)
					}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f, ...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
			key: "<?php $key = env("GMAP_LOCAL"); echo $key; ?>",
			v: "weekly",
			// Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
			// Add other bootstrap parameters as needed, using camel case.
		});

		let map;

		async function initMap() {
			const position = { lat:
						{{$site->lat}}, lng: {{$site->lng}} };
			// Request needed libraries.
			//@ts-ignore
			const { Map } = await google.maps.importLibrary("maps");
			// const { AdvancedMarkerElement } =  await google.maps.importLibrary("marker");

			// The map, centered at position
			map = new Map(document.getElementById("map"), {
				zoom: 12,
				center: position,
				mapTypeId: google.maps.MapTypeId.TERRAIN,
				mapId: "c2290875eac93973",
			});
		}

		initMap();
	</script>
	<x-slot:heading>{{ $site->site_name }}</x-slot:heading>
	<div class="ml-1 flex items-baseline space-x-4 justify-between">
		<a href="/sitelist"
		   class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm border border-gray-300 hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"> « Site list </a>
	</div>
	<div class="mt-4 mb-4 border-1 shadow-xl border border-indigo-800" id="map"></div>
	<div>{{ $site->site_description }}</div>
	<div><strong>Access:</strong> {{$site->site_access }}</div>
	<div><strong>Wind(s): {{$site->site_wind_directions }}</strong></div>
	<div><strong>Coordinates:</strong> Lat: {{$site->lat }} Lng: {{$site->lng }}</div>
	<div><strong>W3W: </strong><a href="https://what3words.com/{{$site->w3w }}">{{$site->w3w}}</a></div>
	{{--	<div><strong>Google maps: </strong><a class = "text-indigo-600 underline hover:no-underline" href="https://maps.google.com?zoom=4&q={{$site->lat}},{{$site->lng}}">click for location</a></div>--}}
</x-layout>