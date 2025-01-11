<x-layout>
    <x-slot:heading>
        Login
    </x-slot:heading>
    <form method="POST" action="/login">
        @csrf
        <div class="space-y-12">
            <div class="mt-3 gap-y-8">
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
            <div><a class="text-xs text-violet-700" href="forgot-password">Lost password? click here</a></div>
            </div>
        <div class=" mt-4 flex items-baseline space-x-4 justify-start">
            <a href="/"  class="rounded-md bg-violet-100 px-3 py-1 text-sm font-light  border border-violet-800  text-violet-600 drop-shadow-lg hover:bg-violet-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Cancel</a>
            <button type="submit" class="rounded-md bg-violet-600 px-3 py-1 text-sm font-light  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Login</button>
        </div>
    </form>
</x-layout>
