<x-layout>
    <x-slot:heading>Club directory</x-slot:heading>
    @foreach ($clubs as $club)
        <li class="ml-4 text-black text-sm">
                {{ $club['name'] }} :: {{$club['description']}}
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