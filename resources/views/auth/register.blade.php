<x-layout>
    <div class="max-w-[500px] border border-gray-900/10 dark:border-white/10 rounded-md p-2 md:p-4 my-16 mx-auto">
        <h1 class="text-4xl font-bold text-center">
            Register
        </h1>
        <form method="POST" action="/register">
            @csrf
            <div class="w-full mt-10 flex flex-col gap-3">
                <div>
                    <x-form-label>First name</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="first_name" name="first_name" placeholder="First name" required></x-form-input>
                        <x-form-error name="first_name"></x-form-error>
                    </div>
                </div>

                <div>
                    <x-form-label>Last name</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="last_name" name="last_name" placeholder="Last name" required></x-form-input>
                        <x-form-error name="last_name"></x-form-error>
                    </div>
                </div>

                <div>
                    <x-form-label>Username</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="username" name="username" placeholder="Username" required></x-form-input>
                        <x-form-error name="username"></x-form-error>
                    </div>
                </div>

                <div>
                    <x-form-label>Email</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="email" name="email" type="email" placeholder="Email" required></x-form-input>
                        <x-form-error name="email"></x-form-error>
                    </div>
                </div>

                <div>
                    <x-form-label>Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="password" name="password" type="password" placeholder="Password" required></x-form-input>
                        <x-form-error name="password"></x-form-error>
                    </div>
                </div>
                <div>
                    <x-form-label>Confirm Password</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm name" required></x-form-input>
                        <x-form-error name="password_confirmation"></x-form-error>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full rounded-md bg-black dark:bg-white px-3 py-2 font-semibold text-white dark:text-black text-sm shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
                </div>
                <div class="sm:col-span-4">
                    <a href="/login" class="my-3 hover:underline">Already have an account? Log in</a>
                </div>
            </div>
        </form>

    </div>

</x-layout>