<x-auth-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" width="150px" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Captcha -->
            <div class="block mt-4">
                <x-label for="captcha" :value="__('Captcha')" />
                <div class="flex items-center">
                    <div id="captcha-image">{!! captcha_img() !!}</div>
                    <div> = </div>
                    <div class="w-full">
                        <input id="captcha"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block ml-1 w-full"
                            type="text" name="captcha" required />
                    </div>
                </div>
                <div>
                    <button type="button" href="#"
                        class="refresh-captcha flex hover:bg-blue-700 hover:text-white p-1 mt-1 rounded">
                        <svg fill="currentColor" height="20px" width="20px" version="1.1" id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 383.748 383.748" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g>
                                    <path
                                        d="M62.772,95.042C90.904,54.899,137.496,30,187.343,30c83.743,0,151.874,68.13,151.874,151.874h30 C369.217,81.588,287.629,0,187.343,0c-35.038,0-69.061,9.989-98.391,28.888C70.368,40.862,54.245,56.032,41.221,73.593 L2.081,34.641v113.365h113.91L62.772,95.042z">
                                    </path>
                                    <path
                                        d="M381.667,235.742h-113.91l53.219,52.965c-28.132,40.142-74.724,65.042-124.571,65.042 c-83.744,0-151.874-68.13-151.874-151.874h-30c0,100.286,81.588,181.874,181.874,181.874c35.038,0,69.062-9.989,98.391-28.888 c18.584-11.975,34.707-27.145,47.731-44.706l39.139,38.952V235.742z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <div class="ml-1">Refresh Captcha</div>
                    </button>
                </div>
                @error('captcha')
                    <div class="text-xs text-red-600">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

    @push('styles')
        <style>
            #captcha-image {
                border: 1px solid #000000;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script>
            $('.refresh-captcha').on('click', function($event) {
                $event.preventDefault();

                $('#captcha-image').html('<span class="p-1"> Loading... </span>');

                $.get("{{ route('refresh-captcha') }}", function(data) {
                    $('#captcha-image').html(data.image);
                });
            });
        </script>
    @endpush

</x-auth-layout>
