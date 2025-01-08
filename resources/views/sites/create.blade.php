<x-layout>

    <x-slot:heading>
        Add a new site
    </x-slot:heading>
    <script>
        window.onbeforeunload = function(){
            var mapzoom=map.getZoom();
            var mapcenter=map.getCenter();
            var maplat=mapcenter.lat();
            var maplng=mapcenter.lng();
            var maptypeid=map.getMapTypeId();
            var cookiestring=maplat+"_"+maplng+"_"+mapzoom+"_"+maptypeid;
            // console.log('setting cookie');
//      Expire at end of session
            setCookie("mapSettings",cookiestring);
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

        window.onbeforeunload = function(){
            var mapzoom=map.getZoom();
            var mapcenter=map.getCenter();
            var maplat=mapcenter.lat();
            var maplng=mapcenter.lng();
            var maptypeid=map.getMapTypeId();
            var cookiestring=maplat+"_"+maplng+"_"+mapzoom+"_"+maptypeid;
//      Expire at end of session
            setCookie("mapSettings",cookiestring);
        }

        document.addEventListener("DOMContentLoaded", function(event) {

        });

    </script>
    <form method="POST" action="/sites/create">

        @csrf

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
//        dump(request());
        @endphp
        <script>

            async function initMap() {
                // const position = { lat:53, lng: -2 };
                // Request needed libraries.
                const mapSettingsCookie = getCookie('mapSettings');

                const { Map } = await google.maps.importLibrary("maps");
                const { AdvancedMarkerElement } =  await google.maps.importLibrary("marker");

                const mapCentre = { lat: @php echo $lat; @endphp, lng: @php echo $lng; @endphp };
                // The map, centered at position
                map = new Map(document.getElementById("map"), {
                    zoom: 12,
                    center: mapCentre,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.TERRAIN,
                    mapId: "c2290875eac93973",
                })

                let lngInput = document.getElementById('lng');
                let latInput = document.getElementById('lat');
                latInput.value = {{$lat}};
                lngInput.value = {{$lng}};

                const marker = new AdvancedMarkerElement({
                    map: map,
                    position: mapCentre,
                    gmpDraggable: true,
                });

                marker.addListener("dragend", (event) => {
                    const position = marker.position;

                    latInput.value = position.lat.toFixed(6)  ;
                    lngInput.value = position.lng.toFixed(6)  ;
                });


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
                key: "<?php $key = env("GMAP_LOCAL"); echo $key; ?>",
                v: "weekly",
                // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
                // Add other bootstrap parameters as needed, using camel case.
            });

            let map;
            initMap();
        </script>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-6 flex items-center justify-between gap-x-6">
                    <h2 class="text-base/7 font-semibold text-gray-900">Site details</h2>
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/auth/profile"  class="rounded-md bg-indigo-100 px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>

                <div class="mt-1 mb-4 border-1 shadow-xl border border-indigo-800" id="map"></div>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    {{--          @php--}}
                    {{--              dump($site['site_description']);--}}
                    {{--          @endphp--}}
                    <div class="sm:col-span-4">

                        <label for="site_name" class="block text-sm/6 font-medium text-gray-900">Name</label>

                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text"
                                       name="site_name"
                                       :value="{{old('site_name')}}"
                                       id="site_name"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                       placeholder="Winter Hill"
                                       required>
                            </div>
                        </div>
                        @error('site_name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-full">
                        <label for="site_description" class="block text-sm/6 font-medium text-gray-900">About</label>
                        <div class="mt-2">



                  <textarea name="site_description"
                            id="site_description"
                            rows="3"

                            class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                            placeholder="Please give information about the site." >{{old('site_description')}}
                  </textarea>
                        </div>
                    </div>
                    @error('site_description')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <div class="col-span-full">
                        <label for="site_access" class="block text-sm/6 font-medium text-gray-900">Access</label>
                        <div class="mt-2">
                  <textarea
                          name="site_access"
                          id="site_access"
                          rows="3"
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                          placeholder="Please give information about how to access the site." >Check</textarea>
                        </div>

                        @error('site_access')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror


                    </div>

                    <div class="sm:col-span-full">
                        <label for="near" class="block text-sm/6 font-medium text-gray-900">Near</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text"
                                       name="near"
                                       id="near"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                       :value="{{old('near')}}"
                                       placeholder="Nearest towns, landmarks">
                            </div>
                        </div>
                    </div>


                    <div class="sm:col-span-full">
                        <label for="site_wind_directions" class="block text-sm/6 font-medium text-gray-900">Site wind directions</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text"
                                       value=""
                                       name="site_wind_directions"
                                       id="site_wind_directions"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                       placeholder="eg  NNE-NE-ENE" >
                            </div>
                        </div>
                        @error('site_wind_directions')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror


                    </div>
                    <input
                            type="hidden"
                            value=""
                            name="lat"
                            id="lat" />

                    <input
                            type="hidden"
                            value=""
                            name="lng"
                            id="lng"
                    />


                    <div class="sm:col-span-full">
                        <label for="w3w" class="block text-sm/6 font-medium text-gray-900">What3Words</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text" name="w3w" id="w3w"
                                       value=""
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="What 3 Words reference eg. delivering.multiplied.racers">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
    </script>
</x-layout>
