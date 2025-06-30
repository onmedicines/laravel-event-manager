<x-layout>

    <x-slot:title>{{ $event->title }}</x-slot:title>

    @can("update", $event)
    <x-slot:buttons>
        <a href="{{ route('events.edit', $event) }}" class="text-center text-md/6 font-semibold text-white bg-indigo-600/80 px-4 py-2 rounded hover:bg-indigo-600 cursor-pointer">
            Edit
        </a>
        <div @click="showConfirm = true, open = false" class="relative text-center text-md/6 font-semibold bg-red-500/80 text-white px-4 py-2 rounded hover:bg-red-500 cursor-pointer">
            Delete
        </div>
        @if (!$event->archived)
        <form method="POST" action="{{ route('events.archive', $event) }}" class="text-center">
            @csrf
            @method('PATCH')

            <button type="submit"
                class="lg:text-gray-600 text-gray-800 text-lg lg:text-md/6 font-semibold cursor-pointer">
                    Archive
            </button>
        </form>
        @else
        <form method="POST" action="{{ route('events.unarchive', $event) }}" class="text-center">
            @csrf
            @method('PATCH')

            <button type="submit"
                class="lg:text-gray-600 text-gray-800 text-lg lg:text-md/6 font-semibold cursor-pointer">
                    Unarchive
            </button>
        </form>
        @endif
    </x-slot:buttons>
    @elseif(auth()->user()->isGuest())
    <x-slot:buttons>
        <form method="POST" action="{{ route('tickets.store', $event) }}" class="text-center">
            @csrf

            <button type="submit" class=" text-md/6 font-semibold text-white bg-indigo-600/80 px-4 py-2 rounded hover:bg-indigo-600 cursor-pointer">
                Buy ticket
            </button>
        </form>
    </x-slot:buttons>
    @endcan


    <!-- Confirmation Modal -->
    <div x-show="showConfirm"
         x-transition
         class="fixed inset-0 bg-opacity-50 flex items-center justify-center z-999"
         x-cloak>
        <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-xl">
            <h2 class="text-lg font-semibold text-gray-800">Delete permanently?</h2>
            <p class="text-sm text-gray-600 mt-2">
                This action <strong class="text-red-600">cannot be undone</strong>. The event will be permanently deleted.
            </p>

            <div class="mt-6 flex justify-end space-x-4">
                <button @click="showConfirm = false"
                    class="px-4 py-2 bg-gray-100 text-gray-800 rounded hover:bg-gray-200 transition">
                    Cancel
                </button>

                <form method="POST" action="{{ route('events.destroy', $event) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        Confirm Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div :class="{ 'blur-sm overflow-hidden': showConfirm }"  class="space-y-8 py-8 transition-all duration-500 ease-in-out motion-reduce:transition-none" style="transition-property: opacity, filter;">
        @if(session('success'))
        <p class="text-green-600 font-semibold">{{ session("success") }}</p>
        @endif

        <h1 class="block lg:hidden z-10 text-2xl font-bold tracking-tight text-gray-700">{{ $event->title }}</h1>

        <!-- Category -->
        <div>
            <p class="text-sm/6 py-2 px-4 border border-pink-300 rounded-full inline text-pink-300"># {{ $event->category }}</p>
        </div>

        <!-- Description -->
        <div>
            <p class="text-lg">{{ $event->description }}</p>
        </div>

        <!-- Date -->
        <div>
            <h3 class="text-md font-semibold text-gray-700">Date & Time</h3>
            <p class="font-semibold text-gray-800">
                @if ($event->end_time)
                    @if ($event->start_time->format('Y-m-d') === $event->end_time->format('Y-m-d'))
                        {{ $event->start_time->format('F j, Y') }} —
                        {{ $event->start_time->format('g:i A') }} to {{ $event->end_time->format('g:i A') }}
                    @else
                        {{ $event->start_time->format('F j, Y, g:i A') }} to {{ $event->end_time->format('F j, Y, g:i A') }}
                    @endif
                @else
                    {{ $event->start_time->format('F j, Y, g:i A') }}
                @endif
            </p>
        </div>

        <!-- Location -->
        <div>
            <h3 class="text-md font-semibold text-gray-700">Location</h3>
            <p class="text-base text-gray-800">{{ $event->location }}</p>
        </div>

        <!-- Price -->
        <div>
            <h3 class="text-md font-semibold text-gray-700">Price</h3>
            <p class="text-base text-gray-800">₹{{ number_format($event->price, 2) }}</p>
        </div>

        <!-- Available Seats -->
        @if ($event->capacity)
        <div>
            <h3 class="text-md font-semibold text-gray-700">Max capacity</h3>
            <p class="text-base text-gray-800">{{ $event->capacity }}</p>
        </div>
        @endif

        <!-- Contact details -->
        <div>
            <h3 class="text-md font-semibold text-gray-700">Contact email</h3>
            <p class="text-base text-gray-800">{{ $event->contact_email }}</p>
        </div>
        @if ($event->contact_phone)
        <div>
            <h3 class="text-md font-semibold text-gray-700">Contact phone</h3>
            <p class="text-base text-gray-800">{{ $event->contact_phone }}</p>
        </div>
        @endif
    </div>
</x-layout>
