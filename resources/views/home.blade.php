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

		(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
			key: "{{env('GMAP_LOCAL')}}",
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

		// function showPosition(position) {
		// 	const x = document.getElementById("demo");
		// 	x.innerHTML = "Latitude: " + position.coords.latitude +
		// 			"<br>Longitude: " + position.coords.longitude;
		// }

		let map;
		async function initMap() {
			// Get marker data
			const markerData = <?php echo json_encode($sites);?>;
			{{--const randomSite = <?php echo json_encode($randomSite);?>;--}}
			// Request needed libraries.
			//@ts-ignore
			const { Map } = await google.maps.importLibrary("maps");
			const { AdvancedMarkerElement } =  await google.maps.importLibrary("marker");
			const { PinElement } = await google.maps.importLibrary("marker");

			const position = { lat: {{$lat}}, lng: {{$lng}} };

			// Initialise map

			map = new Map(document.getElementById("map"), {
				zoom: {{$zoom}},
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

					@auth
			for (i = 0; i < markerData.length; i++) {
				const thisMarker = markerData[i];
				const id = parseFloat(thisMarker['id']);
				const lat = parseFloat(thisMarker['lat']);
				const lng = parseFloat(thisMarker['lng']);
				var name = thisMarker['site_name'];

				var slug = "notes.suggest/" + id;
				const direction = thisMarker['site_wind_directions'];
				const description = thisMarker['site_description'];
				const access = thisMarker['site_access'];

				let content = "<div>" + description + "</div><br><div>Access: " + access + "</div><div><b>Winds: " + direction + "</b><br>Suggest an update - click <a href=\"" + slug + "\">here</a></div>";
				const position = new google.maps.LatLng(lat, lng);
				const marker = new AdvancedMarkerElement({
					map: map,
					position: position,
					title: thisMarker['site_name'],
				});
				marker.addListener("click", () => {
					infoWindow.setHeaderContent(thisMarker['site_name']);
					infoWindow.setContent(content);
					infoWindow.open(map, marker);
					map.panTo(marker.position)
					map.setZoom(13);

					infoWindow.addListener('closeclick', ()=>{
						map.setZoom(10);
						map.panTo(marker.position)
					});
				});
			}


			@endAuth

			@guest
			// A marker with a custom SVG glyph.
			const glyphImg = document.createElement("img");

			glyphImg.src =
					"https://developers.google.com/maps/documentation/javascript/examples/full/images/google_logo_g.svg";

			const glyphSvgPinElement = new PinElement({
				glyph: glyphImg,
			});


			let content = "<div>For full access to over 300 sites<br><strong><a href=\"/register\">Register  here</a></strong></div>";
			for (i = 0; i < markerData.length; i++) {
				const thisMarker = markerData[i];
				let site_id = thisMarker['id'];
				const lat = parseFloat(thisMarker['lat']);
				const lng = parseFloat(thisMarker['lng']);

				const position = new google.maps.LatLng(lat, lng);
				const marker = new AdvancedMarkerElement({
					map: map,
					position: position,
					title: thisMarker['Unknown'],
				});
				marker.addListener("click", () => {

					infoWindow.setHeaderContent('Site ID:' + site_id);
					infoWindow.setContent(content);
					infoWindow.open(map, marker);
					map.panTo(marker.position)
					map.setZoom(13);

					infoWindow.addListener('closeclick', ()=>{
						map.setZoom(10);
						map.panTo(marker.position)
					});
				});
			}
			// Display random site




			const pinBorder = new PinElement({
				background: "violet",
				borderColor: "black",
				glyphColor: "white",
			});
			const randomSite = <?php echo json_encode($randomSite); ?>;
			const thisMarker = randomSite;
			const lat = parseFloat(thisMarker['lat']);
			const lng = parseFloat(thisMarker['lng']);
			var name = "Random site: " + thisMarker['site_name'];

			const direction = thisMarker['site_wind_directions'];
			const description = thisMarker['site_description'];
			const access = thisMarker['site_access'];

			content_alt = "<div>" + description + "</div><br><div>Access: " + access + "</div><div><b>Winds: " + direction + "</b></div>";

			const marker = new AdvancedMarkerElement({
				map: map,
				position: { lat: lat, lng: lng },
				title: name,
				content: pinBorder.element,
			});
			map.panTo(marker.position);

			marker.addListener("click", () => {
				infoWindow.setHeaderContent(name);
				infoWindow.setContent(content_alt);
				infoWindow.open(map, marker);
				map.panTo(marker.position)
				map.setZoom(13);

				infoWindow.addListener('closeclick', ()=>{
					map.setZoom(10);
					map.panTo(marker.position)
				});
			});
			@endguest

			// /


			{{--httpGetAsync("https://api.openweathermap.org/data/3.0/onecall?lat=" + position.lat +"&lon=" + position.lng + "&units=metric&exclude=minutely&appid=<?php echo env('OPEN_WEATHER'); ?>" ,myCallback);--}}
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
	</script>

	<div class="mt-1 mb-4 border-1 shadow-xl border border-indigo-800" id="map"></div>
	<div class="text-black">
		<div class="mt-2 text-violet-900">What's it all about?</div>
		<div class="px-4 text-sm">A fairly comprehensive directory with slope-soaring and weather data - what more do you want? The map here shows one of our many sites selected at random. Click on the marker for full details and an up-to-date wind forecast.</div>
		<div class="mt-2 text-violet-900">History</div>
		<div  class="px-4 text-sm" >Quite a few years ago, Simon Stephens set up his WeatherPermitting website - don't go looking for it, it's not there now - although it's in the online <a class="hover: underline" href="https://web.archive.org/web/20240815163158/http://weatherpermitting.xyz" target="_blank"> Wayback Machine</a>. The site gathered together details of several hundred slope soaring sites throughout the British Isles. Although it no longer exists, Simon has generously shared the data which is available here for the benefit of the soaring community.<br>The current site uses and extends this data to offer a continuation of that approach.
		</div>
		<div class="mt-2 text-violet-900">Why do I need to register?</div>
		<div class="px-4 text-sm">Several reasons. Firstly, registration will give you full access to the site's database of slopes. Secondly,to accept the Conditions of Use of the site and confirm that you will respect landowners, clubs and other users. And finally, you will be able to make your own contribution by adding new or updating existing site information.</div>
		<div class="mt-2 text-violet-900">I had an account on WeatherPermitting - do I need to register?</div>
		<div class="px-4 text-sm">Hopefully, not. Your account detail was provided by Simon and, although it's not been properly tested, it is quite possible that you will be able to login. If you can't login, you should be able to use the 'Lost Password' link.</div>
		<div class="mt-2 text-violet-900">When can I register?</div>
		<div class="px-4 text-sm">Shortly - we're still in development but hopeful of providing a basic service within the next month or so…</div>
	</div>
	@auth()

	@endauth

	{{--	<div class="mt-1 mb-4 border-1 shadow-xl border border-indigo-800" id="forecast"></div>--}}
</x-layout>
