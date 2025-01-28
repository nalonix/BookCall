<x-layout>
    <x-slot:heading>
        Log In
    </x-slot:heading>
    <form method="POST" action="/login">
        @csrf
        <div class="m-3 border border-gray-900/10 dark:border-white/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <x-form-label>Username</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="username" name="username" required></x-form-input>
                        <x-form-error name="username"></x-form-error>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <x-form-label>Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="password" name="password" type="password" required></x-form-input>
                        <x-form-error name="password"></x-form-error>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <a href="/" class="flex justify-center w-full px-3 py-2 rounded-md text-center text-sm font-semibold bg-zinc-900">Cancel</a>
                </div>
                <div class="sm:col-span-4">
                    <button type="submit" class="w-full rounded-md bg-black dark:bg-white px-3 py-2 font-semibold text-white dark:text-black text-sm shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log In</button>
                </div>
            </div>
        </div>
    </form>
</x-layout>