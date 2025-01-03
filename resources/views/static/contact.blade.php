<x-layout>
    @php
    $subject = "Enquiry from SlopeFinderUK";
  @endphp
    <x-slot:heading>Contact SlopeFinder dot UK</x-slot:heading>
    <div class="text-black leading-6">
        <div class="my-4">Enquiries: <a href="mailto:info@slopefinder.uk?subject={{$subject}}">click here - info@slopefinder.uk</a></div>
    </div>
</x-layout>