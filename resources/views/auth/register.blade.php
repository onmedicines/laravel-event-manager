<x-layout>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 sm:mt-4">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-700">Create a new account</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-lg">
            <form class="space-y-6" action="/register" method="POST">
                @csrf
                <div class="flex gap-4">
                    <div class="grow">
                        <label for="first_name" class="block text-sm/6 font-medium text-gray-900">First name</label>
                        <div class="mt-2">
                            <input type="text" name="first_name" id="first_name" autocomplete="true" required value="{{ old('first_name') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <x-form-error name="first_name" />
                        </div>
                    </div>
                    <div class="grow">
                        <label for="last_name" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                        <div class="mt-2">
                            <input type="text" name="last_name" id="last_name" autocomplete="true" required value="{{ old('last_name') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <x-form-error name="last_name" />
                        </div>
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email" autocomplete="email" required value="{{ old('email') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <x-form-error name="email" />
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                    <div class="mt-2">
                        <input type="password" name="password" id="password" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <x-form-error name="password" />
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Confirm password</label>
                    <div class="mt-2">
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center space-x-4">
                        <label for="role" class="block text-sm/6 font-medium text-gray-900">
                            I am here to
                        </label>
                        <select name="role" id="role" class="grow border border-gray-300 shadow-sm rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm px-2 py-1">
                            <option value="organizer" {{ old('role') === 'organizer' ? 'selected' : '' }}>organize events</option>
                            <option value="guest" {{ old('role') === 'guest' ? 'selected' : '' }}>buy tickets</option>
                        </select>
                    </div>
                    <x-form-error name="role" />
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm/6 text-gray-500">
                Already a member?
                <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">
                    Log in an existing account
                </a>
            </p>
        </div>

    </div>

</x-layout>
