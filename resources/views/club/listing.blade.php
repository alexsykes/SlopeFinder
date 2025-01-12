<x-layout>
    <x-slot:heading>Club directory</x-slot:heading>
    <div class="p-4 pt-2 mt-4 border-1 rounded-lg shadow-xl border border-indigo-950">
        <div>
        Please note that the clubs listed below has been inherited from Simon Stephens' WeatherPermitting site and may not reflect current activities.
    </div>
        <div>
            New clubs are always welcomed and are invited to upload their details and share information among the Slope Soaring community. Registered clubs are invited to update their club details.
        </div>
    </div>
    @foreach ($clubs as $club)
        <div class="p-4 pt-2 mt-4 border-1 rounded-lg shadow-xl border border-indigo-950">
            <div class="text-violet-600">{{ $club['name'] }}</div>

        <div>{{$club['description']}}
            @php
                if ($club['website'] != "") { @endphp
            <div>
                Website:  <a class="text-violet-600 underline" href="{{$club['website']}}" target="_blank">click here</a>
            </div>
            @php }  @endphp
            @php
                if ($club['contact_email'] != "") { @endphp
            <div>
                <a href="mailto:{{$club['contact_email']}}">Email:  ️✉️ </a>
            </div>
            @php }  @endphp
            @php
                if ($club['updated_at'] != "") { @endphp
            <div>
                Last update: {{$club['updated_at']->format('M jS, Y')}}
            </div>
            @php }  @endphp
        </div>
        </div>

    @endforeach
</x-layout>