@props(["name"])

@error($name)
<p class="mt-2 text-sm font-semibold text-red-500">{{ $message }}</p>
@enderror
