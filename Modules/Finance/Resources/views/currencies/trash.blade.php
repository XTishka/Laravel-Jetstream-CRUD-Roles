<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('finance::currencies.trash_currency')
        </h2>
    </x-slot>

    @livewire('finance::currencies.trash')

</x-app-layout>
