<x-layout>
    <x-slot:heading>
        Create an account
    </x-slot:heading>
    {{--@php--}}
    {{--    dump(request());--}}
    {{--@endphp--}}

    <form method="POST" action="/register">
{{--        @csrf--}}
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">

                                <input type="text" name="username" id="username" class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6" placeholder="My username" >
                            </div>
                        </div>
                        @error('username')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-4">
                        <label for="user_email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input type="text" name="user_email" id="user_email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="me@example.com" ></input>
                        </div>
                    </div>
                    @error('user_email')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <div class="col-span-4">
                        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  >
                        </div>
                    </div>
                    @error('user_email')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <div class="col-span-4">
                        <label for="confirm_password" class="block text-sm/6 font-medium text-gray-900">Confirm password</label>
                        <div class="mt-2">
                            <input type="password" name="confirm_password" id="confirm_password" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"  >
                        </div>
                    </div>
                    @error('user_email')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror

                    <div class="col-span-4">
                        <label for="accept_terms" class="block text-sm/6 font-medium text-gray-900">Terms and Conditions</label>
                        <div class="mt-2">
                            <input type="checkbox" name="accept_terms" id="accept_terms" class="block rounded-md bg-white px-3 py-1.5 text-base">
                        </div>
                    </div>
                    @error('accept_terms')
                    <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </form>
</x-layout>
