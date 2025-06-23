<x-layout>
    <x-slot:title>
        {{ $ticket->event->title }}
    </x-slot:title>
    <div>
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="text-center flex justify-center">
                {!! QrCode::size(200)->generate($ticket->qr_code) !!}
            </div>
        </div>
    </div>

</x-layout>
