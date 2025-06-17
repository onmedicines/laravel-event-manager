<x-layout>

    <x-slot:title>{{ $event->title }}</x-slot:title>

    @can("create", App\Models\Event::class)
    <x-slot:buttons>
        <a href="{{ route('events.edit', $event) }}" class="self-center text-md/6 font-semibold text-sky-500 border border-sky-500 px-4 py-2 rounded hover:bg-sky-500 hover:text-white transition-colors duration-200 cursor-pointer">
            Edit
        </a>
        <div class="relative self-center">
            <button @click="showConfirm = true, open = false"
                class="text-md/6 font-semibold text-red-500 border border-red-500 px-4 py-2 rounded hover:bg-red-500 hover:text-white transition-colors duration-200 cursor-pointer">
                Delete
            </button>
        </div>
        @if (!$event->archived)
        <form method="POST" action="{{ route('events.archive', $event) }}" class="self-center">
            @csrf
            @method('PATCH')

            <button type="submit"
                class="lg:text-gray-600 text-gray-800 text-lg lg:text-md/6 font-semibold cursor-pointer">
                    Archive
            </button>
        </form>
        @else
        <form method="POST" action="{{ route('events.unarchive', $event) }}" class="self-center">
            @csrf
            @method('PATCH')

            <button type="submit"
                class="lg:text-gray-600 text-gray-800 text-lg lg:text-md/6 font-semibold cursor-pointer">
                    Unarchive
            </button>
        </form>
        @endif

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
        <p class="text-green-500 font-semibold">{{ session("success") }}</p>
        @endif

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
    </div>
</x-layout>
