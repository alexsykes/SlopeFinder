<x-layout>
    <x-slot:heading>
        Editing site: {{ $site->site_name }}
    </x-slot:heading>
    <form method="POST" action="/sitedetail/{{ $site->id }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-6 flex items-center justify-between gap-x-6">
                    <h2 class="text-base/7 font-semibold text-gray-900">Site details</h2>
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/auth/profile"  class="rounded-md bg-indigo-100 px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    {{--          @php--}}
                    {{--              dump($site['site_description']);--}}
                    {{--          @endphp--}}
                    <div id="map" class="col-span-full">
                        Map goes here
                    </div>
                    <div class="sm:col-span-4">

                        <label for="site_name" class="block text-sm/6 font-medium text-gray-900">Name</label>

                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text"
                                       name="site_name"
                                       value="{{ $site->site_name }}"
                                       id="site_name"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                       placeholder="Winter Hill" >
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
                            placeholder="Please give information about the site." >{{ $site->site_description }}</textarea>
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
                          placeholder="Please give information about how to access the site." >{{ $site->site_access  }}</textarea>
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
                                       value="{{ $site->near }}"
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
                                       value="{{ $site->site_wind_directions }}"
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

                    <div class="sm:col-span-1">
                        <label for="lat" class="block text-sm/6 font-medium text-gray-900">Latitude</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input
                                        type="text"
                                        value="{{ $site->lat }}"
                                        name="lat"
                                        id="lat"
                                        class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" >
                            </div>
                        </div>
                        @error('lat')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <label for="lng" class="block text-sm/6 font-medium text-gray-900">Longitude</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input
                                        type="text"
                                        value="{{ $site->lng }}"
                                        name="lng"
                                        id="lng"
                                        class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                >
                            </div>
                        </div>
                    </div>

                    @error('lng')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <div class="sm:col-span-full">
                        <label for="w3w" class="block text-sm/6 font-medium text-gray-900">What3Words</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text" name="w3w" id="w3w"
                                       value="{{ $site->w3w }}"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="What 3 Words reference eg. delivering.multiplied.racers">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>


    </form>
</x-layout>
