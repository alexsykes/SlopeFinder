<x-layout>
	<style type="text/css">
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		#map {
			height: 600px;
			width: 100%;
		}

		#markerForm {
			display: none;
		}

	</style>
<x-slot:heading>SlopeFinder Demo</x-slot:heading>
	<script>
		(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
			key: "{{env('GMAP_LOCAL')}}",
			v: "weekly",
			// Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
			// Add other bootstrap parameters as needed, using camel case.
		});


		let map;
		function showPosition(position) {
			const x = document.getElementById("demo");
			x.innerHTML = "Latitude: " + position.coords.latitude +
					"<br>Longitude: " + position.coords.longitude;
		}



		async function initMap() {
			const markerData = <?php echo json_encode($sites); ?>;

			// Request needed libraries.
			//@ts-ignore
			const { Map } = await google.maps.importLibrary("maps");
			const { AdvancedMarkerElement } =  await google.maps.importLibrary("marker");

			const position = { lat: 54.543, lng: -2.7764678 };
			map = new Map(document.getElementById("map"), {
				zoom: 10,
				center: position,
				streetViewControl: false,
				mapTypeControl: false,
				mapTypeId: google.maps.MapTypeId.TERRAIN,
				mapId: "c2290875eac93973",
			});


			const infoWindow = new google.maps.InfoWindow({
				content: "",
				disableAutoPan: false,
			});


						for (i = 0; i < markerData.length; i++) {
									const thisMarker = markerData[i];
									const id = thisMarker['id'];
									const lat = thisMarker['lat'];
									const lng = thisMarker['lng'];
									const name = thisMarker['site_name'];

									const direction = thisMarker['site_wind_directions'];
									const description = thisMarker['site_description'];
									const access = thisMarker['site_access'];
									// const facings = JSON.parse(thisMarker[8]);
					    // console.log(facings);
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
									// /
							marker.addListener("click", () => {
								infoWindow.setHeaderContent(name);
								infoWindow.setContent(content);
								infoWindow.open(map, marker);
								map.panTo(marker.position)
								map.setZoom(13);

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
			// 			});
			// 	httpGetAsync("https://api.openweathermap.org/data/3.0/onecall?lat=" + position.coords.latitude + "&lon=" + position.coords.longitude + "&units=metric&exclude=minutely&appid=",myCallback)
			// }
			// else {


				{{--httpGetAsync("https://api.openweathermap.org/data/3.0/onecall?lat=" + position.lat +"&lon=" + position.lng + "&units=metric&exclude=minutely&appid=<?php echo env('OPEN_WEATHER'); ?>" ,myCallback);--}}
			// }
		}
		function httpGetAsync(theUrl, callback)
		{
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.onreadystatechange = function() {
				if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
					callback(xmlHttp.responseText);
			}
			xmlHttp.open("GET", theUrl, true); // true for asynchronous
			xmlHttp.send(null);
		}

		function myCallback(responseText) {
			let forecast = document.getElementById("forecast");
			let weatherData =  JSON.parse(responseText);
			let lat = weatherData['lat'];
			let sunrise = weatherData['daily'][0]['summary'];

			let hourlyData = weatherData['hourly'];
			for ( let i in hourlyData) {
				console.log( i + ":: Wind: " + hourlyData[i]['wind_speed'] + " at " + hourlyData[i]['wind_deg'] + "°")
				}
			forecast.innerHTML = "Current Wind:";
		}
		initMap();
	</script><div class="mt-1 mb-4 border-1 shadow-xl border border-indigo-800" id="map"></div>

	@auth()

	@endauth

	<div class="mt-1 mb-4 border-1 shadow-xl border border-indigo-800" id="forecast"></div>
</x-layout>
