<x-layout>
    <x-slot:heading>Suggestion</x-slot:heading>
    @php

 @endphp


    <form method="POST" action="/notes.store">
        @csrf
        <x-form-field>
            <x-form-label for="description">Suggest an update for {{$site->site_name}}</x-form-label>
            <div class="mt-4">
                <textarea name ="description" id="description" rows="5"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 drop-shadow-lg outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Your suggestion here…" required ></textarea>
                <x-form-error name="description" />
            </div>
        </x-form-field>
        <input type = "hidden" id="site_id" name="item_id" value="{{$site->id}}">
        <input type = "hidden" id="type" name="type" value="site">
        <div class="mt-4 flex items-baseline space-x-4 justify-start">
            <a href="/auth/profile"  class="rounded-md  bg-violet-100 px-3 py-1 text-sm font-light border border-violet-800 text-violet-800 drop-shadow-lg hover:bg-violet-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Cancel</a>
            <button type="submit" class="rounded-md bg-violet-600 px-3 py-1 text-sm font-light  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Submit</button>
        </div>
    </form>
</x-layout>