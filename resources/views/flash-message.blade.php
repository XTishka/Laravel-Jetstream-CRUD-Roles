@if ($message = Session::get('success'))
    <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
        <input type="checkbox" class="hidden" id="footertoast">

        <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-100 h-24 rounded shadow-lg text-green-800" title="close" for="footertoast">
            <div>
                <h4 class="font-bold">{{ __('Success!') }}</h4>
                <p class="text-sm">{{ $message }}</p>
            </div>
            <svg class="fill-current text-green-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>

        </label>
    </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
            <input type="checkbox" class="hidden" id="footertoast">

            <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-red-100 h-24 rounded shadow-lg text-red-800" title="close" for="footertoast">
                <div>
                    <h4 class="font-bold">{{ __('Error!') }}</h4>
                    <p class="text-sm">{{ $message }}</p>
                </div>
                <svg class="fill-current text-red-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>

            </label>
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
            <input type="checkbox" class="hidden" id="footertoast">

            <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-orange-100 h-24 rounded shadow-lg text-orange-800" title="close" for="footertoast">
                <div>
                    <h4 class="font-bold">{{ __('Warning!') }}</h4>
                    <p class="text-sm">{{ $message }}</p>
                </div>
                <svg class="fill-current text-orange-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>

            </label>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">
            <input type="checkbox" class="hidden" id="footertoast">

            <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-blue-100 h-24 rounded shadow-lg text-blue-800" title="close" for="footertoast">
                <div>
                    <h4 class="font-bold">{{ __('Info!') }}</h4>
                    <p class="text-sm">{{ $message }}</p>
                </div>
                <svg class="fill-current text-blue-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>

            </label>
        </div>
    @endif

{{--    @if ($errors->any())--}}
{{--        <div class="max-w-6xl mx-auto pt-10 sm:px-6 lg:px-8">--}}
{{--            <div class="bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative" role="alert">--}}
{{--                <span class="block sm:inline">{{ $message }}</span>--}}
{{--                <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click.prevent="message = null">--}}
{{--                <svg class="fill-current h-6 w-6 text-orange-500" role="button" xmlns="http://www.w3.org/2000/svg"--}}
{{--                     viewBox="0 0 20 20">--}}
{{--                <title>Close</title>--}}
{{--                <path--}}
{{--                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>--}}
{{--                </svg>--}}
{{--            </span>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--<div class="alert-toast fixed bottom-0 right-0 m-8 w-5/6 md:w-full max-w-sm">--}}
{{--    <input type="checkbox" class="hidden" id="footertoast">--}}

{{--    <label class="close cursor-pointer flex items-start justify-between w-full p-2 bg-green-100 h-24 rounded shadow-lg text-green-800" title="close" for="footertoast">--}}
{{--        <div>--}}
{{--            <h4 class="font-bold">{{ __('Success!') }}</h4>--}}
{{--            <p class="text-sm">{{ $message }}</p>--}}
{{--        </div>--}}
{{--        <svg class="fill-current text-green-800" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">--}}
{{--            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>--}}
{{--        </svg>--}}

{{--    </label>--}}
{{--</div>--}}
{{--    @endif--}}
