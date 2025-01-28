@props(['name'])

@error($name)
<p class="mt-3 text-sm/6 text-red-600">{{ $message }}</p>
@enderror