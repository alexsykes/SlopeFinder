<x-layout>
    <x-slot:heading>
        Create an account
    </x-slot:heading>

    <form method="POST" action="/register">
        <div class="ml-10 flex items-baseline space-x-4 justify-end">
            <a href="/"  class="rounded-md bg-indigo-100 px-3 py-2 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cancel</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
        </div>
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">


                    <div class="sm:col-span-4">

                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>

                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text"
                                       name="name"
                                       value=""
                                       id="name"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                       placeholder="My name" >
                            </div>
                        </div>
                        @error('name')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror

                        <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>

                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                {{--              <div class="shrink-0 select-none text-base text-gray-500 sm:text-sm/6">workcation.com/</div>--}}
                                <input type="text"
                                       name="username"
                                       value=""
                                       id="username"
                                       class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                       placeholder="My username" >
                            </div>
                        </div>
                        @error('username')
                        <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                        @enderror










                    <div class="col-span-6">
                        <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                        <div class="mt-2">
                            <input type="text" name="email" id="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="me@example.com" >
                        </div>
                    </div>
                    @error('email')
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
                        <div class="text-xs">I accept the terms and conditions</div>
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
        </div>
    </form>
</x-layout>
