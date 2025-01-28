<x-layout>
    <div class="max-w-[500px] border border-gray-900/10 dark:border-white/10 rounded-md p-2 md:p-4 my-16 mx-auto">
        <h1 class="text-4xl font-bold text-center">
            Log In
        </h1>
        <form method="POST" action="/login">
            @csrf
            <div class="w-full mt-10 flex flex-col gap-3">
                <div>
                    <x-form-label>Username</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="username" name="username" required></x-form-input>
                        <x-form-error name="username"></x-form-error>
                    </div>
                </div>
                <div>
                    <x-form-label>Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="password" name="password" type="password" required></x-form-input>
                        <x-form-error name="password"></x-form-error>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <button type="submit" class="w-full rounded-md bg-black dark:bg-white px-3 py-2 font-semibold text-white dark:text-black text-sm shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log In</button>
                </div>
                <div>
                    <a href="/register" class="my-3 hover:underline">Don't have an account? Register</a>
                </div>
            </div>
        </form>
    </div>
</x-layout>