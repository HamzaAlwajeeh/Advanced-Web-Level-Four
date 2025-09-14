@props(['active' => 'false', 'type' => 'a'])

<{{ $type }} {{ $attributes }}
    class="{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5' }} rounded-md px-3 py-2 text-sm font-medium">
    {{ $slot }}</{{ $type }}>
