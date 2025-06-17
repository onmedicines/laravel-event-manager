<x-layout>
    <x-slot:title>Update event details</x-slot:title>

    <form method='POST' action="{{ route('events.update', $event) }}" class="space-y-12 mt-4">
        @csrf
        @method('PATCH')

        <div class="max-w-4xl space-y-12">
            <!-- Title -->
            <div class="space-y-2">
                <x-form-label for="title">Title <span class="text-red-500">*</span></x-form-label>
                <x-form-input type="text" name="title" id="title" required placeholder="Choose a title for the event, eg. Tech Conference 2025" :value="$event->title" />
                <x-form-error name="title" />
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <x-form-label for="description">Description</x-form-label>
                <x-form-input type="textarea" name="description" id="description" rows="6" required placeholder="Describe your event in a few sentences such as its features, what all can be expected, etc." :value="$event->description" />
                <x-form-error name="description" />
            </div>

            <!-- Category -->
            <div class="space-y-2">
                <x-form-label for="category">Event Category <span class="text-red-500">*</span></x-form-label>
                <select name="category" id="category" required class="w-full px-2 py-1 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                    <option value="" disabled>Select a category</option>
                    @foreach (['Music', 'Technology', 'Art', 'Business', 'Sports', 'Education', 'Other'] as $cat)
                        <option value="{{ $cat }}" {{ $event->category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                <x-form-error name="category" />
            </div>

            <!-- Start and End Time -->
            <div class="flex flex-col sm:flex-row sm:space-x-8 space-y-12 sm:space-y-0">
                <div class="space-y-2 grow">
                    <x-form-label for="start_time">Select event start date and time <span class="text-red-500">*</span></x-form-label>
                    <x-form-input type="datetime-local" name="start_time" id="start_time" required :value="$event->start_time->format('Y-m-d\TH:i')" />
                    <x-form-error name="start_time" />
                </div>
                <div class="space-y-2 grow">
                    <x-form-label for="end_time">Select event end date and time (optional)</x-form-label>
                    <x-form-input type="datetime-local" name="end_time" id="end_time" :value="optional($event->end_time)->format('Y-m-d\TH:i')" />
                    <x-form-error name="end_time" />
                </div>
            </div>

            <!-- Location -->
            <div class="space-y-2">
                <x-form-label for="location">Location <span class="text-red-500">*</span></x-form-label>
                <x-form-input type="textarea" name="location" id="location" rows="4" required placeholder="Venue or address, e.g. Central Hall, New Delhi" :value="$event->location" />
                <x-form-error name="location" />
            </div>

            <!-- Landmark -->
            <div class="space-y-2">
                <x-form-label for="landmark">Landmark</x-form-label>
                <x-form-input type="text" name="landmark" id="landmark" placeholder="Near Connaught Place, Gate No. 3" :value="$event->landmark" />
                <x-form-error name="landmark" />
            </div>

            <!-- Price -->
            <div class="space-y-2 grow">
                <x-form-label for="price">Price (₹)</x-form-label>
                <x-form-input type="text" name="price" id="price" required placeholder="Enter ticket price, e.g. 299.99" :value="$event->price" />
                <x-form-error name="price" />
            </div>

            <!-- Capacity -->
            <div class="space-y-2">
                <x-form-label for="capacity">Max Capacity (optional)</x-form-label>
                <x-form-input type="number" name="capacity" id="capacity" placeholder="e.g. 200" min="1" :value="$event->capacity" />
                <x-form-error name="capacity" />
            </div>

            <!-- Publish Checkbox -->
            <!-- <div class="space-y-2 grow">
                <div class="flex space-x-4">
                    <input type="checkbox" name="publish" id="publish" {{ $event->is_published ? 'checked' : '' }} />
                    <x-form-label for="publish">Publish the event immediately? (You can do it later)</x-form-label>
                </div>
                <x-form-error name="publish" />
            </div> -->
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 pt-8">
            <x-link href="{{ route('events.show', $event) }}" class="">Cancel</x-link>
            <button type="submit" class="text-md/6 font-semibold text-sky-500 border border-sky-500 px-4 py-2 rounded hover:bg-sky-500 hover:text-white transition-colors duration-200 cursor-pointer">Save</button>
        </div>
    </form>
</x-layout>
