<x-layout>
    <x-slot:heading>
        Account activation
    </x-slot:heading>

    <div class="p-4 pt-2 mt-4 border-1 rounded-lg shadow-xl border border-indigo-950">

        <div class="flex items-center m-auto px ">If you are a new user, an email will have been sent to your registered email address. You may need to check whether it is in your Spam or Junk mail folder.
            Once you have activated your account, you will have full access to the site.
        </div>

        <div class="flex mt-2 items-center m-auto px ">If you are a previous user of WeatherPermitting, click on the Resend link below to get an Activation link.
        </div>

        <form action="/email/verification-notification" method="POST">
            @csrf
            <button type="submit" class="rounded-md  mt-4  bg-violet-600 px-3 py-1 text-sm font-light  border border-violet-800 text-white drop-shadow-lg hover:bg-violet-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-violet-600">Resend email verification</button>
        </form>
    </div>
</x-layout>