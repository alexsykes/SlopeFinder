<x-layout>
    <x-slot:heading>
        Editing site: {{ $club->name }}
    </x-slot:heading>

    <form method="POST" action="/club/update/{{$club->id}}">
        @csrf
        @method('PATCH')
        <div class=" flex items-baseline space-x-4 justify-start">
            <a href="/auth/profile"  class="rounded-md  bg-violet-100 px-3 py-1 text-sm font-light border border-violet-800 text-violet-800 drop-shadow-lg hover:bg-violet-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Cancel</a>
            <button type="submit" class="rounded-md bg-violet-600 px-3 py-1 text-sm font-light  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Save</button>
        </div>
        <div class="space-y-12">
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <x-form-field>
                    <x-form-label for="name">Club Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="name" id="name" :value="old('name')" value="{{ $club->name }}" required />
                        <x-form-error name="name" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="contact_name">Contact Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="contact_name" id="contact_name" value="{{$club->contact_name}}"  required />
                        <x-form-error name="contact_name" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="contact_email">Contact email</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="contact_email" type="email" id="contact_email" value="{{$club->contact_email}}"  required />
                        <x-form-error name="contact_email" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="website">Website</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="website"  id="website" value="{{$club->website}}"  required />
                        <x-form-error name="website" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="description">Description</x-form-label>
                    <div class="mt-2">
                        <textarea name ="description" id="description" rows="5"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  required >{{ $club->description }}</textarea>
                        <x-form-error name="description" />
                    </div>
                </x-form-field>
            </div>
        </div>
    </form>
</x-layout>