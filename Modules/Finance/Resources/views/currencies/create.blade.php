<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('finance::currencies.create_currency')
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('finance.currencies.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="title" class="block font-medium text-sm text-gray-700">
                                @lang('finance::currencies.title')
                            </label>
                            <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('title', '') }}" />
                            @error('title')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="code" class="block font-medium text-sm text-gray-700">
                                @lang('finance::currencies.currency_code')
                            </label>
                            <input type="text" name="code" id="code" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('code', '') }}" />
                            @error('code')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="designation" class="block font-medium text-sm text-gray-700">
                                @lang('finance::currencies.designation')
                            </label>
                            <input type="text" name="designation" id="designation" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('designation', '') }}" />
                            @error('designation')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="base_currency" name="base_currency" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="base_currency" class="font-medium text-gray-700">
                                        @lang('finance::currencies.base_currency')
                                    </label>
                                    <p class="text-gray-500">@lang('finance::currencies.set_base_currency')</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between">
                            <a href="{{ route('finance.currencies') }}"
                               class="inline-flex items-center px-4 py-2 mx-2 bg-transparent border border-gray-500 rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-500 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                @lang('finance::currencies.back_to_list')
                            </a>
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                @lang('finance::currencies.create')
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
