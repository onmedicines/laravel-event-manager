<x-layout>
    <x-slot:title>Create new event</x-slot:title>

    <form method='POST' action='/dashboard/events' class="space-y-12 mt-4">
        @csrf

        <div class="mt-8 lg:mt-0 max-w-4xl space-y-12">
            <!-- Title -->
            <div class="space-y-2">
                <x-form-label for="title">Title <span class="text-red-500">*</span></x-form-label>
                <x-form-input type="text" name="title" id="title" required placeholder="Choose a title for the event, eg. Tech Conference 2025" />
                <x-form-error name="title" />
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <x-form-label for="description">Description <span class="text-red-500">*</span></x-form-label>
                <x-form-input type="textarea" name="description" id="description" rows="6" required placeholder="Describe your event in a few sentences such as its features, what all can be expected, etc." />
                <x-form-error name="description" />
            </div>

            <!-- Category -->
            <div class="space-y-2">
                <x-form-label for="category">Event Category <span class="text-red-500">*</span></x-form-label>
                <select name="category" id="category" required class="w-full px-2 py-1 rounded-md shadow-sm focus:ring-sky-500 focus:border-sky-500">
                    <option value="" disabled selected>Select a category</option>
                    <option value="Music">Music</option>
                    <option value="Technology">Technology</option>
                    <option value="Art">Art</option>
                    <option value="Business">Business</option>
                    <option value="Sports">Sports</option>
                    <option value="Education">Education</option>
                    <option value="Other">Other</option>
                </select>
                <x-form-error name="category" />
            </div>


            <!-- Start and End Time -->
            <div class="flex flex-col sm:flex-row sm:space-x-8 space-y-12 sm:space-y-0">
                <div class="space-y-2 grow">
                    <x-form-label for="start_time">Select event start date and time <span class="text-red-500">*</span></x-form-label>
                    <x-form-input type="datetime-local" name="start_time" id="start_time" required/>
                    <x-form-error name="start_time" />
                </div>
                <div class="space-y-2 grow">
                    <x-form-label for="end_time">Select event end date and time (optional)</x-form-label>
                    <x-form-input type="datetime-local" name="end_time" id="end_time" />
                    <x-form-error name="end_time" />
                </div>
            </div>

            <!-- Location -->
            <div class="space-y-2">
                <x-form-label for="location">Location <span class="text-red-500">*</span></x-form-label>
                <x-form-input type="textarea" name="location" id="location" rows="4" required placeholder="Venue or address, e.g. Central Hall, New Delhi" />
                <x-form-error name="location" />
            </div>

            <!-- Landmark -->
            <div class="space-y-2">
                <x-form-label for="landmark">Landmark</x-form-label>
                <x-form-input type="text" name="landmark" id="landmark" placeholder="Near Connaught Place, Gate No. 3" />
                <x-form-error name="landmark" />
            </div>

            <!-- Lat/Long -->
            <!-- <div class="flex space-x-8">
                <div class="space-y-2 grow">
                    <x-form-label for="latitude">Latitude (e.g. 28.6139)</x-form-label>
                    <x-form-input type="number" step="0.0000001" min="-90" max="90" name="latitude" id="latitude"/>
                    <x-form-error name="latitude" />
                </div>
                <div class="space-y-2 grow">
                    <x-form-label for="longitude">Longitude (e.g. 77.2090)</x-form-label>
                    <x-form-input type="number" step="0.0000001" min="-180" max="180" name="longitude" id="longitude" />
                    <x-form-error name="longitude" />
                </div>
            </div> -->

            <!-- Price -->
            <div class="space-y-2 grow">
                <x-form-label for="price">Price (₹) <span class="text-red-500">*</span></x-form-label>
                <x-form-input type="text" name="price" id="price" required placeholder="Enter ticket price, e.g. 299.99" />
                <x-form-error name="price" />
            </div>

            <!-- Capacity -->
            <div class="space-y-2">
                <x-form-label for="capacity">Max Capacity (optional)</x-form-label>
                <x-form-input type="number" name="capacity" id="capacity" placeholder="e.g. 200" min="1" />
                <x-form-error name="capacity" />
            </div>

            <!-- Slug -->
            <!-- <div class="space-y-2">
                <x-form-label for="slug">Custom URL Slug (optional)</x-form-label>
                <x-form-input type="text" name="slug" id="slug" placeholder="e.g. music-fest-2025" />
                <x-form-error name="slug" />
            </div> -->

            <!-- Publish Checkbox -->
            <!-- <div class="space-y-2 grow">
                <div class="flex space-x-4">
                    <input type="checkbox" name="publish" id="publish"/>
                    <x-form-label for="publish">Publish the event immediately? (You can do it later)</x-form-label>
                </div>
                <x-form-error name="publish" />
            </div> -->

        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 pt-8">
        <x-link href="{{ route('dashboard') }}" class="">Cancel</x-link>
            <button type="submit" class="text-md/6 font-semibold text-sky-500 border border-sky-500 px-4 py-2 rounded hover:bg-sky-500 hover:text-white transition-colors duration-200 cursor-pointer">Create</button>
        </div>
    </form>
</x-layout>
