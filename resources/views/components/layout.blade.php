<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    </head>
    <body x-data="{ open: false, showConfirm: false }" class="h-full text-gray-600">

        <div class="bg-white">
            <header :class="{ 'blur-sm overflow-hidden': showConfirm }" class="absolute inset-x-0 top-0 z-50 px-4">
                <nav class="flex items-center justify-between py-6 max-w-7xl mx-auto" aria-label="Global">
                        <div :class="{ 'blur-sm overflow-hidden': open || showConfirm }" class="flex lg:flex-1 transition-all duration-500 ease-in-out motion-reduce:transition-none" style="transition-property: opacity, filter;">
                            <a href="/" class="-m-1.5 p-1.5">
                                <span class="sr-only">Your Company</span>
                                <img class="h-6 w-auto" src="{{ asset('tailwindcss-mark.d52e9897.svg') }}" alt="logo">
                            </a>
                        </div>
                        <!-- Hamburger Button for Small Screens -->
                        <div class="flex lg:hidden" @keydown.window.escape="open = false">
                            <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                                <span class="sr-only">Open menu</span>
                                <svg class="h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                                <svg class="h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>

                            <!-- Slide-in Mobile Menu -->
                            <div
                                x-show="open"
                                x-transition:enter="transition transform ease-out duration-300"
                                x-transition:enter-start="translate-x-full"
                                x-transition:enter-end="translate-x-0"
                                x-transition:leave="transition transform ease-in duration-300"
                                x-transition:leave-start="translate-x-0"
                                x-transition:leave-end="translate-x-full"
                                class="fixed inset-y-0 right-0 z-100 w-64 md:w-72 bg-white shadow-md py-6 px-4 lg:hidden"
                                @click.away="open = false"
                            >
                                <nav class="flex flex-col items-end space-y-8">
                                    <button @click="open = !open" type="button" class="mb-8 inline-flex items-center justify-center p-2 text-gray-700 hover:text-gray-900 focus:outline-none">
                                        <span class="sr-only">Open menu</span>
                                        <svg class="h-6 w-6" x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                        </svg>
                                        <svg class="h-6 w-6" x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                    <!-- <a href="/" @click="open = false" class="self-center text-gray-800 hover:text-blue-600 text-lg font-semibold">Home</a>
                                    <a href="/events" @click="open = false" class="self-center text-gray-800 hover:text-blue-600 text-lg font-semibold">Events</a>
                                    <a href="/tickets" @click="open = false" class="self-center text-gray-800 hover:text-blue-600 text-lg font-semibold">Tickets</a>
                                    <a href="/contact" @click="open = false" class="self-center text-gray-800 hover:text-blue-600 text-lg font-semibold">Contact</a> -->

                                    @guest
                                    <a href="/login" @click="open = false" class="self-center text-gray-800 text-lg font-semibold hover:text-gray-600 transition-all">Log in</a>
                                    <a href="/register" @click="open = false" class="self-center text-gray-800 text-lg font-semibold hover:text-gray-600 transition-all">Register</a>
                                    @endguest

                                    @auth
                                    @isset($buttons)
                                    {{  $buttons }}
                                    @endisset
                                    <form method="POST" action="/logout" @submit="open = false" class="self-center">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="text-left w-full text-gray-800 hover:text-red-600 text-lg font-semibold transition-all">Log out</button>
                                    </form>
                                    @endauth
                                </nav>
                            </div>
                        </div>



                    @guest
                    <div class="hidden lg:flex lg:justify-end lg:gap-6">
                        <x-link href="/login" class="">Log in</x-link>
                        <x-link href="/register" class="">Register</x-link>
                    </div>
                    @endguest

                    @auth
                    <form method="POST" action="/logout" class="hidden lg:flex lg:justify-end">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="text-md/6 font-semibold hover:underline cursor-pointer">Log out <span aria-hidden="true">&rarr;</span></button>
                    </form>
                    @endauth

                </nav>
            </header>

            <main class="pt-14 px-4">
                @auth
                <div class="hidden lg:flex ">
                    <div class="w-full bg-white border-b-2 border-gray-200 flex items-center justify-between max-w-7xl mx-auto py-6">
                        <h1 class="z-10 text-2xl font-bold tracking-tight text-gray-700">{{ $title }}</h1>
                       <div :class="{ 'blur-sm overflow-hidden': showConfirm }" class="z-10 flex items-center gap-12 transition-all duration-500 ease-in-out motion-reduce:transition-none" style="transition-property: opacity, filter;">
                        @isset($buttons)
                        {{  $buttons }}
                        @endisset
                       </div>
                    </div>
                </div>
                @endauth

                <div
                  :class="{ 'blur-sm overflow-hidden': open }"
                  class="relative isolate pt-4 lg:pt-0 pb-16 transition-all duration-500 ease-in-out motion-reduce:transition-none"
                  style="transition-property: opacity, filter;"
                >
                    <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                        <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                    </div>
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                    <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                        <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
