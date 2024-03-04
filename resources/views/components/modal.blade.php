@props([
'name',
'show' => false,
'maxWidth' => '2xl'
])

@php
$maxWidth = [
'sm' => 'sm:max-w-sm',
'md' => 'sm:max-w-md',
'lg' => 'sm:max-w-lg',
'xl' => 'sm:max-w-xl',
'2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div x-data="{ show: @js($show) }" x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })" x-on:keydown.escape.window="show = false" x-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
    <div class="fixed inset-0 transform transition-all" x-on:click="show = false" x-show="show">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="{{ $maxWidth }} mx-auto sm:px-6 lg:px-8" x-show="show">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all">
            {{ $slot }}
        </div>
    </div>
</div>
