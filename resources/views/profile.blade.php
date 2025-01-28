<x-user-layout>
    <form method="POST" action="/profile" enctype="multipart/form-data" class="w-full p-2">
        @csrf
        @method('PATCH') <!-- Use PUT or PATCH for updating the profile -->
        <div class="p-2 md:p-4 border border-gray-900/10 dark:border-white/10 rounded-md mb-6">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-6">
                <!-- Avatar Upload -->
                <div class="sm:col-span-6 flex">
                    <div class="preview w-24 h-24 bg-white rounded-md overflow-hidden border border-gray-300">
                        <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}"
                            alt="Profile Picture" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col justify-between p-2">
                        <x-form-label class="text-xl font-semibold">Avatar</x-form-label>
                        <div class="mt-2">
                            <label for="avatar" class="block w-32 py-1 bg-zinc-700 hover:bg-zinc-600 rounded-sm text-center text-sm font-semibold text-gray-700 dark:text-white cursor-pointer duration-100 ease-in-out">
                                Browse
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/*"
                                class="hidden text-sm text-gray-900 border border-gray-300 rounded-sm cursor-pointer bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                            <x-form-error name="avatar"></x-form-error>
                        </div>
                    </div>
                </div>

                <!-- Username Input -->
                <div class="sm:col-span-6">
                    <x-form-label>Username</x-form-label>
                    <div class="mt-2 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center pl-3 pr-1 rounded-l-md bg-zinc-50 text-gray-500 dark:bg-zinc-700 dark:text-white">bookcall.com/</span>
                        <x-form-input id="username" name="username" class="flex-1 block w-full rounded-none rounded-r-md" value="{{ $user->username }}" required></x-form-input>
                    </div>
                    <x-form-error name="username"></x-form-error>
                </div>

                <!-- First and Last Names -->
                <div class="sm:col-span-3">
                    <x-form-label>First Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="first_name" name="first_name" value="{{ $user->first_name }}" required></x-form-input>
                        <x-form-error name="first_name"></x-form-error>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <x-form-label>Last Name</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="last_name" name="last_name" value="{{ $user->last_name }}" required></x-form-input>
                        <x-form-error name="last_name"></x-form-error>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="sm:col-span-6">
                    <x-form-label>Email</x-form-label>
                    <div class="mt-2">
                        <x-form-input id="email" name="email" type="email" value="{{ $user->email }}" required></x-form-input>
                        <x-form-error name="email"></x-form-error>
                    </div>
                </div>

                <!-- Bio Input -->
                <div class="sm:col-span-6">
                    <x-form-label>Bio</x-form-label>
                    <div class="mt-2">
                        <textarea id="bio" name="bio" rows="4" class="block w-full p-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-zinc-500/50 dark:bg-zinc-800 dark:border-gray-600 dark:text-white dark:placeholder-gray-400">{{ $user->bio }}</textarea>
                        <x-form-error name="bio"></x-form-error>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="sm:col-span-6 flex justify-between gap-4">
                    <a href="/" class="flex justify-center w-full px-3 py-2 rounded-md text-center text-sm font-semibold bg-zinc-900 dark:bg-zinc-700 text-white dark:text-white hover:bg-zinc-800 dark:hover:bg-zinc-600">Cancel</a>
                    <button type="submit" class="w-full rounded-md bg-black dark:bg-white px-3 py-2 font-semibold text-white dark:text-black text-sm shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Profile</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete Account Section -->
    <!-- <div class="flex flex-col rounded-md p-2 pt-0">
        <div class="p-3 md:p-4 pt-2 border border-red-700/30 rounded-md">
            <x-form-label class="!text-red-600 !dark:text-red-600 font-semibold text-xl">Danger Zone</x-form-label>
            <div class="mt-2">
                <p class="text-red-600 pb-2 text-sm">
                    This action will permanently delete your account and free up the username for others to use.
                </p>
                <x-confirmation-popup
                    id="delete-account"
                    type="danger"
                    triggerText="Delete Account"
                    popupHeader="Confirm Deletion"
                    popupMessage="Are you sure you want to delete your account? This action cannot be undone.">
                    <form id="delete-form" method="POST" action="/profile">
                        @csrf
                        @method('DELETE')

                        <div class="mt-4 flex justify-end space-x-3">
                            <button id="cancel-delete-btn" type="button"
                                class="px-4 py-1 bg-zinc-300 text-gray-900 font-semibold rounded-md hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-1 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700">
                                Delete
                            </button>
                        </div>
                    </form>
                </x-confirmation-popup>

            </div>
        </div>
    </div> -->
</x-user-layout>