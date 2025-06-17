<x-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <x-slot:buttons>
        <a href="/dashboard/events/create" class="self-center z-10 text-md/6 font-semibold text-sky-500 border border-sky-500 px-4 py-2 rounded hover:bg-sky-500 hover:text-white transition-colors duration-200 cursor-pointer">
            New event
        </a>
    </x-slot:buttons>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:p-0 lg:pt-4 py-8">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-start space-x-4 pb-6">
            <h1 class="text-lg font-bold">Your Events</h1>

            <form method="GET" action="{{ route('events.index') }}" class="mt-4 sm:mt-0">
                <label for="sort" class="sr-only">Sort</label>
                <select name="sort" id="sort" onchange="this.form.submit()" class="border border-gray-300 shadow-sm rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm px-2 py-1">
                    <option value="az" {{ request('sort') === 'az' ? 'selected' : '' }}>A → Z</option>
                    <option value="za" {{ request('sort') === 'za' ? 'selected' : '' }}>Z → A</option>
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="upcoming" {{ request('sort') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                    <option value="ongoing" {{ request('sort') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="archived" {{ request('sort') === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($events as $e)
                <a href={{ route("events.show", $e) }} class="bg-white/30 backdrop-blur-sm hover:backdrop-blur-md p-6 shadow-sm rounded-xl transition" >
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
