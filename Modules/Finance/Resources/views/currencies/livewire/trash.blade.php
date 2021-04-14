<div>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8 flex justify-between">
            <a href="{{ route('finance.currencies') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
                @lang('finance::currencies.back_to_list')
            </a>
            <input type="text"  class="block text-sm font-medium text-gray-700 w-96 rounded-full pl-2 pr-2  focus:outline-none focus:shadow-outline" placeholder="@lang('finance::currencies.search')" wire:model="searchTerm" />
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

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex justify-end">
                                        <form class="inline-block"
                                              action="{{ route('finance.currencies.restore', $currency->id) }}"
                                              method="POST" onsubmit="return confirm(@lang('finance::currencies.sure'));">
                                            <input type="hidden" name="_method" value="PUT">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                   value="@lang('finance::currencies.restore')">
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600 hover:text-indigo-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 15v-1a4 4 0 00-4-4H8m0 0l3 3m-3-3l3-3m9 14V5a2 2 0 00-2-2H6a2 2 0 00-2 2v16l4-2 4 2 4-2 4 2z" />
                                                    </svg>
                                            </button>
                                        </form>
                                        <form class="inline-block"
                                              action="{{ route('finance.currencies.forcedelete', $currency->id) }}"
                                              method="POST" onsubmit="return confirm(@lang('finance::currencies.sure'));">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2"
                                                   value="@lang('finance::currencies.complete_delete')">
                                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="paggination p-2">
                            {{ $currencies->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block mb-8 mt-10">
            <a href="{{ route('finance.currencies') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
                @lang('finance::currencies.back_to_list')
            </a>
        </div>
    </div>
</div>