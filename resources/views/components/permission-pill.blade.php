@props([
    'permission',
    'icon',
    'info',
])

@php
$bgcolor = [
    'yes' => 'bg-green-500',
    'ask' => 'bg-yellow-500',
    'no' => 'bg-red-500',
][$permission];

$status = [
    'yes' => 'OPEN',
    'ask' => 'ASK',
    'no' => 'CLOSED',
][$permission];
@endphp

<div>
    <x-tooltip>
        <div class="flex justify-center items-center {{ $bgcolor }} rounded-md size-9">
            <i class="fa-solid {{ $icon }} fa-sm"></i>
        </div>
        <x-slot:tooltip>
            {{ $status }} {{ $info }}
        </x-slot>
    </x-tooltip>
</div>
