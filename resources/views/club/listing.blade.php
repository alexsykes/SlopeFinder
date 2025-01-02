<x-layout>
    <x-slot:heading>Club directory</x-slot:heading>
    @foreach ($clubs as $club)
        <li class="text-indigo-700">
                <strong>{{ $club['name'] }}</strong> :: {{$club['description']}}
            @php
                if ($club['website'] != "") { @endphp
            <a href="{{$club['website']}}"> 🕸️ </a>
            @php }  @endphp
            @php
                if ($club['contact_email'] != "") { @endphp
            <a href="mailto:{{$club['contact_email']}}"> ️✉️ </a>
            @php }  @endphp
        </li>
    @endforeach
</x-layout>