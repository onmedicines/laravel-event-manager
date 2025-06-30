<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <x-slot:buttons>
        @can('create', App\Models\Event::class)
        <a href="/dashboard/events/create" class="text-center z-10 text-md/6 font-semibold bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 cursor-pointer">
            New event
        </a>
        <a href="/dashboard/scan" class="text-center z-10 text-md/6 font-semibold bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 cursor-pointer">
            Scan
        </a>
        @else
        <a href="/dashboard/buyer/tickets" class="text-center z-10 text-md/6 font-semibold bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 cursor-pointer">
            My tickets
        </a>
        @endcan
    </x-slot:buttons>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:p-0 lg:pt-4 py-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-x-4 pb-6">
            @can('create', App\Models\Events::class)
            <h1 class="text-lg font-bold">Your Events</h1>
            @else
            <h1 class="text-lg font-bold">Available Events</h1>
            @endcan

            @php
            if (auth()->user()->role === 'organizer'){
                $action = route('events.index');
            }
            else if (auth()->user()->role === 'guest'){
                $action = route('guest.events.index');
            }
            @endphp


            <form method="GET" action="{{ $action }}" class="mt-4 sm:mt-0">
                <label for="sort" class="sr-only">Sort</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="border border-gray-300 shadow-sm rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm px-2 py-1">
                    <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A → Z</option>
                    <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Z → A</option>
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                    @can("create", App\Models\Event::class)
                    <!-- user is an organizer and hence can view ended events -->
                    <option value="ended" {{ request('sort') === 'ended' ? 'selected' : '' }}>Ended</option>
                    <!-- user is an organizer and hence can view upcoming events -->
                    <option value="upcoming" {{ request('sort') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <!-- user is an organizer and hence can view ongoing events -->
                    <option value="ongoing" {{ request('sort') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <!-- user is an organizer and hence can view archived events -->
                    <option value="archived" {{ request('sort') === 'archived' ? 'selected' : '' }}>Archived</option>
                    @endcan
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($events as $e)
                <a href={{ route("events.show", $e) }} class="bg-white/30 backdrop-blur-sm hover:backdrop-blur-md p-6 shadow-sm rounded-xl transition">
                    @if ($e->end_time < now())
                    <p class="text-xs text-red-400 font-semibold">ended</p>
                    @elseif ($e->start_time < now() && $e->end_time > now())
                    <p class="text-xs text-amber-500 font-semibold">ongoing</p>
                    @elseif ($e->start_time > now())
                    <p class="text-xs text-green-600 font-semibold">upcoming</p>
                    @endif
                    <h2 class="text-xl font-semibold mb-2">{{ $e->title }}</h2>
                    <p class="text-sm">{{ $e->start_time->format('F j, Y') }}</p>
                    <p class="text-sm">{{ $e->start_time->format('g:i A') }}</p>
                </a>
            @empty
                <p class="text-gray-500 col-span-full text-center">No events found.</p>
            @endforelse
        </div>

    </div>


</x-layout>
