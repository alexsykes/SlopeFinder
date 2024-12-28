<x-layout>
    <x-slot:heading>
        Create an account
    </x-slot:heading>

    <form method="POST" action="/register">
        <div class=" flex items-baseline space-x-4 justify-start">
            <a href="/"  class="rounded-md  bg-violet-100 px-3 py-1 text-sm font-semibold border border-violet-800 text-violet-800 drop-shadow-lg hover:bg-violet-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Cancel</a>
            <button type="submit" class="rounded-md bg-violet-600 px-3 py-1 text-sm font-semibold  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Register</button>
        </div>
        @csrf
        <div class="space-y-12">
            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <x-form-field>
                    <x-form-label for="name">Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="name" id="name" :value="old('name')"  required />
                        <x-form-error name="name" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="username">Username</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="username" id="username" :value="old('username')"  required />
                        <x-form-error name="username" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="email">Email</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="email" id="email" type="email" :value="old('email')"  required
                        />
                        <x-form-error name="email" />
                    </div>
                </x-form-field>

                <x-form-field>
                    <x-form-label for="password">Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password" id="password" type="password"  required />
                        <x-form-error name="password" />
                    </div>
                </x-form-field>
                <x-form-field>
                    <x-form-label for="password_confirmation">Confirm password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password_confirmation" id="password_confirmation" type="password" required />
                        <x-form-error name="password_confirmation" />
                    </div>
                </x-form-field>

                <div class="col-span-4">
                    <label for="accept_terms" class="block text-sm/6 font-medium text-gray-900">Terms and Conditions</label>
                    <div class="text-xs">I accept the terms and conditions</div>
                    <div class="mt-2">
                        <input type="checkbox"
                               name="accept_terms"
                               id="accept_terms"
                               class="block rounded-md bg-white px-3 py-1.5 text-base"
                               required>
                    </div>
                </div>
                @error('accept_terms')
                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                @enderror


            </div>
        </div>
    </form>
</x-layout>
