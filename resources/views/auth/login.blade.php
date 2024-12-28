<x-layout>
    <x-slot:heading>
        Create an account
    </x-slot:heading>

    <form method="POST" action="/login">
        <div class=" flex items-baseline space-x-4 justify-start">
            <a href="/"  class="rounded-md bg-indigo-100 px-3 py-2 text-sm font-semibold text-indigo-800 drop-shadow-lg hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white drop-shadow-lg hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Login</button>
        </div>
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <x-form-field>
                        <x-form-label for="name">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="email" id="email" :value="old('email')" required />
                            <x-form-error name="email" />
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="name">Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input name="password" id="password" type="password"  required />
                            <x-form-error name="password" />
                        </div>
                    </x-form-field>
                </div>
            </div>
        </div>
    </form>
</x-layout>
