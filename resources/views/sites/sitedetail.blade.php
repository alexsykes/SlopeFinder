<x-layout>
    <style>

        .weathertable {
            column-width: 10em;
            column-rule: 1px solid rgb(75 70 74);
        }

        .fw {
            width: 200px;
            display: inline-block;
        }
    </style>
    <script>
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

        window.onload = function() {
            {{--console.log("Loaded");--}}
            {{--lat = {{$site->lat}};--}}
            {{--lng = {{$site->lng}};--}}
            {{--theURL = "https://api.openweathermap.org/data/3.0/onecall?lat=" + lat + "&lon=" + lng + "&exclude=minutely,alerts,current&units=metric&appid=cb7a4bca45b294a2d6db1e66cb43e678"--}}

            {{--console.log(theURL);--}}
            {{--httpGetAsync(theURL, myCallback())--}}
        }

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

            console.log(responseText);
            // let lat = weatherData['lat'];
            // let sunrise = weatherData['daily'][0]['summary'];

            // let hourlyData = weatherData['hourly'];
            // for ( let i in hourlyData) {
            // 	console.log( i + ":: Wind: " + hourlyData[i]['wind_speed'] + " at " + hourlyData[i]['wind_deg'] + "°")
            // }
            forecast.innerHTML = responseText;
        }

        async function initMap() {
            const position = { lat:
                        {{$site->lat}}, lng: {{$site->lng}} };
            // Request needed libraries.
            //@ts-ignore
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement } =  await google.maps.importLibrary("marker");

            // The map, centered at position
            map = new Map(document.getElementById("map"), {
                zoom: 12,
                center: position,
                streetViewControl: false,
                mapTypeId: google.maps.MapTypeId.TERRAIN,
                mapId: "c2290875eac93973",
            })

            const contentString = "<div><b>{{$site->site_name}}</b></div>";
            // The marker, positioned at Uluru
            const marker = new AdvancedMarkerElement({
                map: map,
                position: position,
                title:"{{$site->site_name}}",
            });
            // var infoWindow = new google.maps.InfoWindow({
            // 	size: new google.maps.Size(150,50)
            // });
            //      marker.addListener("click", () => {
            //      infoWindow.setContent(contentString);
            //      infoWindow.open(map, marker);
            //    });

        }


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
            key: "{{$_ENV['GMAP_API']}}",
            v: "weekly",
            // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
            // Add other bootstrap parameters as needed, using camel case.
        });

        let map;

        initMap();
    </script>
    @php
        //    dd(json_decode($site->forecast->data));



    @endphp
    <x-slot:heading>{{ $site->site_name }}</x-slot:heading>
    <div class="ml-1 flex items-baseline space-x-4 justify-between">
        <a href="{{ url()->previous() }}"
           class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm border border-gray-300 hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"> « Site list </a>
    </div>
    <div class="mt-4 mb-4 border-1 shadow-xl border border-indigo-800" id="map"></div>
    <div class="text-sm">
        <div><strong>About this site: </strong>{{ $site->site_description }}</div>
    <div><strong>Access:</strong> {{$site->site_access }}</div>
    <div><strong>Wind(s): {{$site->site_wind_directions }}</strong></div>
    <div><strong>Coordinates:</strong> Lat: {{$site->lat }}° Lng: {{$site->lng }}°</div>
    <div><strong>W3W: </strong><a href="https://what3words.com/{{$site->w3w }}">{{$site->w3w}}</a></div>
    <div><strong>Site details last updated:</strong> {{$site->updated_at->format('M jS, Y') }}</div>
    <div><strong>Weather last updated :</strong> {{$site->forecast->updated_at->format('M jS, g:ia') }}</div>
</div>
    {{--	<div><strong>Google maps: </strong><a class = "text-indigo-600 underline hover:no-underline" href="https://maps.google.com?zoom=4&q={{$site->lat}},{{$site->lng}}">click for location</a></div>--}}
    @php
        $data = json_decode($site->forecast->data);
        $hourly = $data->hourly;
        $directions = array("N", "NNE","NE","ENE","E","ESE","SE", "SSE","S","SSW", "SW", "WSW", "W", "WNW", "NW", "NNW", "N");
    @endphp
    <div id="weathertable" class="weathertable">
    @foreach($hourly as $hourData)
        @php
            $time = date("D ga", $hourData->dt);
            $windSpeeds = intval($hourData->wind_speed)." ~ ".intval($hourData->wind_gust);
            $dir = $hourData->wind_deg;

            $windIndex = (int) (($dir * 16 / 360) + 0.5);
            $dir = $directions[$windIndex];
        @endphp
        <div class="fw text-sm">
            <div class="inline">{{$time}} {{$windSpeeds}} mph {{$dir}}</div>
        </div>
    @endforeach
    </div>
{{--    <table class="text-xs">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <td class="text-sm font-bold" colspan="3">48 hour forecast</td>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        @php--}}
{{--            $data = json_decode($site->forecast->data);--}}
{{--            $hourly = $data->hourly;--}}
{{--            $directions = array("N", "NNE","NE","ENE","E","ESE","SE", "SSE","S","SSW", "SW", "WSW", "W", "WNW", "NW", "NNW", "N");--}}
{{--            $numcolumns = 3;--}}
{{--        @endphp--}}
{{--        <tr>--}}
{{--            @php--}}
{{--                for($i = 0; $i < sizeof($hourly)/$numcolumns; $i++) {--}}
{{--                    echo "<td>";--}}

{{--                    for($ii = 0; $ii < $numcolumns; $ii++ ) {--}}
{{--                    $hourData = $hourly[$i + ($ii * 16)];--}}
{{--                    $time = date("D ga", $hourData->dt);--}}
{{--                    $windSpeeds = intval($hourData->wind_speed)." ~ ".intval($hourData->wind_gust);--}}
{{--                    $dir = $hourData->wind_deg;--}}

{{--                    $windDirection = (int) (($dir * 16 / 360) + 0.5);--}}
{{--            @endphp--}}
{{--            <td>{{$time}} {{$directions[$windDirection]}}: {{$windSpeeds}} m/s</td>--}}
{{--        @php--}}
{{--            }--}}
{{--        echo "</tr>";--}}

{{--    }--}}
{{--        @endphp--}}
{{--    </table>--}}
</x-layout>