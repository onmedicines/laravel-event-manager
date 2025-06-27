<x-layout>
    <x-slot:title>Tickets</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:p-0 lg:pt-4 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-x-4 pb-6">
            <form method="GET" action="{{ route('tickets.index') }}" class="mt-4 sm:mt-0">
                <label for="sort" class="sr-only">Sort</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="border border-gray-300 shadow-sm rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm px-2 py-1">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Recently bought</option>
                    <option value="ended" {{ request('sort') === 'ended' ? 'selected' : '' }}>Ended</option>
                    <option value="upcoming" {{ request('sort') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="ongoing" {{ request('sort') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($tickets as $t)
            <div class="flex flex-col gap-2">
                <a href="{{ route('events.show', $t->event) }}" class="bg-white/30 backdrop-blur-sm hover:backdrop-blur-md rounded-xl transition p-6 shadow-sm">
                    @if ($t->event->end_time < now())
                    <p class="text-xs text-red-400 font-semibold">ended</p>
                    @elseif ($t->event->start_time < now() && $t->event->end_time > now())
                    <p class="text-xs text-amber-500 font-semibold">ongoing</p>
                    @elseif ($t->event->start_time > now())
                    <p class="text-xs text-green-600 font-semibold">upcoming</p>
                    @endif
                    <h2 class="text-xl font-semibold mb-2">{{ $t->event->title }}</h2>
                    <p class="text-sm">{{ $t->event->start_time->format('F j, Y') }}</p>
                    <p class="text-sm">{{ $t->event->location }}</p>
                </a>
                <a href="{{ route('tickets.show', $t) }}" class="self-start font-semibold bg-white/30 backdrop-blur-sm hover:backdrop-blur-md rounded-lg transition p-2 shadow-sm">
                    View qr
                </a>
            </div>
            @empty
            <p class="text-gray-500 col-span-full text-center">No tickets yet</p>
            @endforelse
        </div>
    </div>
</x-layout>
