<x-layout>
    <x-slot:heading>Notes</x-slot:heading>
    <div class="px-2 py-2 bg-white border-1 border-gray-400 rounded-md px-2  outline outline-1 -outline-offset-1 drop-shadow-lg outline-gray-300">
        <table class="table-auto">
            <caption class="caption-top px-2 py-2">User Notes</caption>
            <thead>
            <tr class="text-sm" >
                <th class="px-2 py-2">Type</th>
                <th class="px-2 py-2">Item ID</th>
                <th class="px-2 py-2">Comment</th>
                <th class="px-2 py-2">User ID</th>
                <th class="px-2 py-2">Date</th>
                <th class="px-2 py-2">Edit</th>
            </tr>
            </thead>
            <tbody>
            @php
                //    dump($pending);
                //    dump($processed);
            @endphp
            @foreach($pending as $note)

                <tr class="text-sm" >
                    <td class="border px-2 ">{{ $note->type }}</td>
                    <td class="border px-2 ">{{ $note->item_id }}</td>
                    <td class="border px-2 ">{{ $note->note }}</td>
                    <td class="border px-2 ">{{ $note->user_id }}</td>
                    <td class="border px-2 ">{{ $note->created_at->format('dS M, Y') }}</td>
                    <td class="border px-2 "><a href="{{$note->type}}/processnotes/{{$note->item_id}}"><i class="fa-solid fa-pen"></i></a>
                    </td></tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <div class="px-2 py-2 mt-6 bg-white border-1 border-gray-400 rounded-md px-2  outline outline-1 -outline-offset-1 drop-shadow-lg outline-gray-300">
        <table class="table-auto">
            <caption class="caption-top px-2 py-2">Completed User Notes</caption>
            <thead>
            <tr class="text-sm" >
                <th class="px-2 py-2">Type</th>
                <th class="px-2 py-2">Item ID</th>
                <th class="px-2 py-2">Comment</th>
                <th class="px-2 py-2">User ID</th>
                <th class="px-2 py-2">Created</th>
                <th class="px-2 py-2">Completed</th>
                <th class="px-2 py-2">Accepted</th>
            </tr>
            </thead>
            <tbody>
            @foreach($processed as $note)

                <tr class="text-sm" >
                    <td class="border px-2 ">{{ $note->type }}</td>
                    <td class="border px-2 ">{{ $note->item_id }}</td>
                    <td class="border px-2 ">{{ $note->note }}</td>
                    <td class="border px-2 ">{{ $note->user_id }}</td>
                    <td class="border px-2 ">{{ $note->created_at->format('dS M, Y') }}</td>
                    <td class="border px-2 ">{{ $note->updated_at->format('dS M, Y') }}</td>
                    <td class="border px-2 ">
                        @if ($note->accepted)
                            <i class="fa-solid fa-circle-check">
                                @else
                                    <i class="fa-solid fa-circle-xmark"></i>
                                        @endif</a>
                    </td></tr>
            @endforeach
            </tbody>
        </table>
    </div>

</x-layout>