<x-layout>
    <x-slot:heading>
        My Profile
    </x-slot:heading>

    <form method="POST" action="profile.update">
{{--        <div class=" flex items-baseline space-x-4 justify-start">--}}
{{--            <a href="/"  class="rounded-md bg-violet-100 px-3 py-1 text-sm font-light  border border-violet-800  text-violet-600 drop-shadow-lg hover:bg-violet-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Cancel</a>--}}
{{--            <button type="submit" class="rounded-md bg-violet-600 px-3 py-1 text-sm font-light  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Login</button>--}}
{{--        </div>--}}
        @csrf
        <div class="space-y-12">
            <div class="mt-6  gap-x-6 gap-y-8 text-sm font-light text-violet-600">
                <div class="mt-2" id="email">Name: {{Auth::user()->name}}</div>
                <div class="mt-2" id="email">Username: {{Auth::user()->username}}</div>
                <div class="mt-2" id="email">Email: {{Auth::user()->email}}</div>
                <div class="mt-2" id="email">My Sites: {{Auth::user()->email}}</div>
                <div class="mt-2" id="email">My Clubs: {{Auth::user()->email}}</div>

            </div>
        </div>
    </form>
</x-layout>
