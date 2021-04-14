<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('finance::currencies.currencies')
        </h2>
    </x-slot>

    @livewire('finance::currencies.index')

</x-app-layout>