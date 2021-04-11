<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('finance::currencies.trash_currency')
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('finance.currencies') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">
                    @lang('finance::currencies.back_to_list')
                </a>
            </div>

            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @lang('finance::currencies.title')
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @lang('finance::currencies.currency_code')
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @lang('finance::currencies.designation')
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($currencies as $currency)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $currency->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $currency->title }}
                                            @if ($currency->base_currency == 'on')
                                                <div class="text-sm text-gray-500">@lang('finance::currencies.base_currency')</div>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $currency->code }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $currency->designation }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
{{--                                            <a href="{{ route('finance.currencies.restore', $currency->id) }}"--}}
{{--                                               class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Restore</a>--}}
                                            <form class="inline-block"
                                                  action="{{ route('finance.currencies.restore', $currency->id) }}"
                                                  method="POST" onsubmit="return confirm(@lang('finance::currencies.sure'));">
                                                <input type="hidden" name="_method" value="PUT">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                       value="@lang('finance::currencies.restore')">
                                            </form>
                                            <form class="inline-block"
                                                  action="{{ route('finance.currencies.forcedelete', $currency->id) }}"
                                                  method="POST" onsubmit="return confirm(@lang('finance::currencies.sure'));">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                       value="@lang('finance::currencies.complete_delete')">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="block mb-8 mt-10">
                <a href="{{ route('finance.currencies') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">
                    @lang('finance::currencies.back_to_list')
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
