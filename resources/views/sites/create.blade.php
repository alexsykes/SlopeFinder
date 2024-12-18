<x-layout>
    <x-slot:heading>
        Add a new Site
</x-slot:heading>


<form method="POST" action="/sites">
    @csrf
  <div class="space-y-12">
    <div class="border-b border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Site details</h2>

      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-4">
          <label for="site_name" class="block text-sm/6 font-medium text-gray-900">Name</label>
          <div class="mt-2">
            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
{{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
              <input type="text" name="site_name" id="site_name" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="Winter Hill">
            </div>
          </div>
        </div>

          <div class="col-span-full">
              <label for="site_description" class="block text-sm/6 font-medium text-gray-900">About</label>
              <div class="mt-2">
                  <textarea name="site_description" id="site_description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Please give information about the site."></textarea>
              </div>
          </div>

          <div class="col-span-full">
              <label for="site_access" class="block text-sm/6 font-medium text-gray-900">Access</label>
              <div class="mt-2">
                  <textarea name="site_access" id="site_access" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Please give information about how to access the site."></textarea>
              </div>
          </div>



          <div class="sm:col-span-full">
              <label for="near" class="block text-sm/6 font-medium text-gray-900">Near</label>
              <div class="mt-2">
                  <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                      {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                      <input type="text" name="near" id="near" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="Nearest towns, landmarks">
                  </div>
              </div>
          </div>


          <div class="sm:col-span-full">
              <label for="lng" class="block text-sm/6 font-medium text-gray-900">Site wind directions</label>
              <div class="mt-2">
                  <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                      {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                      <input type="text" name="site_wind_directions" id="site_wind_directions" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="eg  NNE-NE-ENE">
                  </div>
              </div>
          </div>

          <div class="sm:col-span-1">
              <label for="lat" class="block text-sm/6 font-medium text-gray-900">Latitude</label>
              <div class="mt-2">
                  <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                      {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                      <input type="text" name="lat" id="lat" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6">
                  </div>
              </div>
          </div>

          <div class="sm:col-span-1">
              <label for="lng" class="block text-sm/6 font-medium text-gray-900">Longitude</label>
              <div class="mt-2">
                  <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                      {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                      <input type="text" name="lng" id="lng" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6">
                  </div>
              </div>
          </div>
      </div>
    </div>


  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
  </div>
</form>
</x-layout>
