<x-layout>
@php
$cookie_name = 'mapSettings';
$lat = 54;
$lng = -2;
$zoom = 12;
if(isset($_COOKIE[$cookie_name])) {
    $cookieData = $_COOKIE[$cookie_name];
	$cookieArray = explode('_', $cookieData);

    $lat = $cookieArray[0];
    $lng = $cookieArray[1];
    $zoom = $cookieArray[2];
}

@endphp
<x-slot:heading>SlopeFinder</x-slot:heading>

	<script>



		(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
			key: "<?php echo env('GMAP_API'); ?>",
			v: "weekly",
			// Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
			// Add other bootstrap parameters as needed, using camel case.
		});

		window.onbeforeunload = function(){
			var mapzoom=map.getZoom();
			var mapcenter=map.getCenter();
			var maplat=mapcenter.lat();
			var maplng=mapcenter.lng();
			var maptypeid=map.getMapTypeId();
			var cookiestring=maplat+"_"+maplng+"_"+mapzoom+"_"+maptypeid;
			console.log('setting cookie');
//      Expire at end of session
			setCookie("mapSettings",cookiestring);
		}

		let map;
		function showPosition(position) {
			const x = document.getElementById("demo");
			x.innerHTML = "Latitude: " + position.coords.latitude +
					"<br>Longitude: " + position.coords.longitude;
		}

		async function initMap() {
			const markerData = <?php echo json_encode($allSites); ?>;

			const { Map } = await google.maps.importLibrary("maps");
			const { AdvancedMarkerElement } =  await google.maps.importLibrary("marker");

			const mapCentre = { lat: {{$lat}}, lng: {{$lng}} };
			map = new Map(document.getElementById("map"), {
				zoom: {{$zoom}},
				center: mapCentre,
				streetViewControl: false,
				mapTypeControl: false,
				mapTypeId: google.maps.MapTypeId.TERRAIN,
				mapId: "c2290875eac93973",
			});


			const infoWindow = new google.maps.InfoWindow({
				content: "",
				disableAutoPan: false,
			});


			// console.log(markerData);
			for (i = 0; i < markerData.length; i++) {
				const thisMarker = markerData[i];

				// console.log(thisMarker);
				// const id = thisMarker['id'];
				const lat = thisMarker['lat'];
				const lng = thisMarker['lng'];
				const name = thisMarker['site_name'];

				const direction = thisMarker['site_wind_directions'];
				const description = thisMarker['site_description'];
				const access = thisMarker['site_access'];
				// const facings = JSON.parse(thisMarker[8]);
//     console.log(facings);
// 				const link = "<a href=\"https://temporary.slopefinder.uk/index.php/site-list/sitedetail/" + id + "\">Click for details</a>";

//    const content = "<div>" + description + "</div><br><div>Access: " + access + "</div><div><b>Winds: " + direction + "</b></div><div><a href=\"<?php //echo $editLink; ?>"  + id + "\">Edit</a></div>"  ;

				const content = "<div>" + description + "</div><br><div>Access: " + access + "</div><div><b>Winds: " + direction + "</b></div>";
//    console.log("lat: " + lat + " lng: " + lng);
				const position = new google.maps.LatLng(lat, lng);
				const marker = new AdvancedMarkerElement({
					map: map,
					position: position,
					title: name,
				});
				//
				marker.addListener("click", () => {
					infoWindow.setHeaderContent(name);
					infoWindow.setContent(content);
					infoWindow.open(map, marker);
					// map.panTo(marker.position);
					// map.setZoom(13);

					infoWindow.addListener('closeclick', ()=>{
						//       map.setZoom(10);
						//       map.panTo(marker.position)
					});

				});
			}
			// if (navigator.geolocation) {
			// 	navigator.geolocation.getCurrentPosition(function (position) {
			// 		initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			// 		map.setCenter(initialLocation);
			// 	});
			// }
		}

		initMap();
		function setCookie(name, value, expires)   {
			document.cookie = name + "=" + escape(value) + "; Secure; SameSite=None;  path=/" + ((expires == null) ? "" : "; expires=" + expires.toGMTString());
		}

		function getCookie(c_name)  {
			if (document.cookie.length>0)
			{
				c_start=document.cookie.indexOf(c_name + "=");
				if (c_start!=-1)
				{
					c_start=c_start + c_name.length+1;
					c_end=document.cookie.indexOf(";",c_start);
					if (c_end==-1) c_end=document.cookie.length;
					return unescape(document.cookie.substring(c_start,c_end));
				}
			}
			return "";
		}

		window.onbeforeunload = function(){
			var mapzoom=map.getZoom();
			var mapcenter=map.getCenter();
			var maplat=mapcenter.lat();
			var maplng=mapcenter.lng();
			var maptypeid=map.getMapTypeId();
			var cookiestring=maplat+"_"+maplng+"_"+mapzoom+"_"+maptypeid;
			console.log('setting cookie');
//      Expire at end of session
			setCookie("mapSettings",cookiestring);
		}
	</script>



	<div class="mt-1 mb-4 border-1 shadow-xl border border-indigo-800" id="map"></div>
	<!-- a  href="/sites/create"  class="relative inline-flex items-center px-4 py-2 mb-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300 rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-200 hover:text-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add a new site</a -->
<ul>
	@foreach ($sites as $site)
		<li class="text-black">
			<a href="/sitedetail/{{ $site['id'] }}">
				<strong>{{ $site['site_name'] }}</strong></a> :: {{$site['site_wind_directions']}}

		</li>
	@endforeach
</ul>
	<div>
			{{ $sites->links() }}
</div>
</x-layout>
