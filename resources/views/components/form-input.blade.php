@props(['type' => 'text', 'value' => null])

@php
    $inputName = $attributes->get('name');
    $value = old($inputName, $value);
@endphp

<div class="flex items-center rounded-md bg-white px-2 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
    @if ($type == 'textarea')
    <textarea {{ $attributes->merge(["class" => "block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"]) }}>{{ $value }}</textarea>
    @else
    <input {{ $attributes->merge(["type" => $type, "class" => "block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6", "value" => $value]) }} />
    @endif
</div>
