<x-layout>
    <x-slot:heading>
        Reset password
    </x-slot:heading>

        @if ($errors->get('email'))
        <div class="text-red-500">
            {{$errors->first('email')}}
        </div>
        @endif
    <form method="POST" action="/reset-password">
        @csrf
        <div class="space-y-12">
            <div class="mt-3 gap-y-8">
                <x-form-field>
                    <x-form-label for="name">New password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password" id="password" type="password" :value="old('password')" required />
                        <x-form-error name="password" />
                    </div>
                </x-form-field>
                <x-form-field>
                    <x-form-label for="name">Confirm password</x-form-label>
                    <div class="mt-2">
                        <x-form-input name="password_confirmation" type="password" id="password_confirmation"  required />
                        <x-form-error name="password_confirmation" />
                    </div>
                </x-form-field>
                <input type="hidden" value="{{$token}}" id="token" name="token">
                <input type="hidden" value="{{request()->email}}" id="email" name="email">

            </div>
        </div>
        <div class=" mt-4 flex items-baseline space-x-4 justify-start">
            <a href="/"  class="rounded-md bg-violet-100 px-3 py-1 text-sm font-light  border border-violet-800  text-violet-600 drop-shadow-lg hover:bg-violet-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Cancel</a>
            <button type="submit" class="rounded-md bg-violet-600 px-3 py-1 text-sm font-light  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Reset</button>
        </div>
    </form>
</x-layout>
