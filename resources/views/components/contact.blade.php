<x-layout>
    @php
    $subject = "Enquiry from SlopeFinderUK";
  @endphp
    <x-slot:heading>Contact SlopeFinder dot UK</x-slot:heading>
    <div class="text-violet-800 leading-5 text-xs">
        <div class="my-2">Enquiries: <a href="mailto:info@slopefinder.uk?subject={{$subject}}">click here</a></div>
    </div>
</x-layout>