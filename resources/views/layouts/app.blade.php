<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{asset('images/cso_favicon.png')}}" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <script>
            try {
                if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark')
                document.querySelector('meta[name="theme-color"]').setAttribute('content', '#0B1120')
                } else {
                document.documentElement.classList.remove('dark')
                }
            } catch (_) {}
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .loaded .loading-screen {
                display: none;
            }
            .tab li a.active {
                border-bottom: 1px solid #255be2;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="loading-screen w-full h-full fixed block top-0 left-0 bg-white z-50">
            <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style="top: 50%;">
                <div role="status">
                    <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </span>
        </div>
        <div class="min-h-screen bg-white bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if(session('status'))
            <div class="max-w-7xl mx-auto px-4 pt-4 sm:px-6 lg:px-8">
                <div id="alert-border-1" class="flex p-4 mb-4 text-blue-800 border-t-4 border-blue-300 bg-blue-50 dark:text-blue-400 dark:bg-gray-800 dark:border-blue-800" role="alert">
                    <div class="ml-3 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            @endif

            @if ($errors->any())
            <div class="max-w-7xl mx-auto px-4 pt-4 sm:px-6 lg:px-8">
                <div class="alert alert-danger">
                    <div id="alert-border-2" class="flex p-4 mb-4 text-red-800 border-t-4 border-red-300 bg-red-50 dark:text-red-400 dark:bg-gray-800 dark:border-red-800" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('extra_components')

        <script src="{{ asset('/js/jquery.js') }}"></script>
        <script>
            $(document).on('click', '.toggle-modal', function () {
                var target = $(this).data('modal-target');
                $('#'+target).toggle();
                $('#action-loading-icon').hide();
            });
            $(document).on('change', 'input[type="checkbox"]', function(){
                this.value = (Number(this.checked)) == 1? 'true': 'false';
            });
            $('.take-action').click(function() {
                var target = "#"+$(this).data('modal-target');
                $(target+' #action-loading-icon').show();
                $(target+' button').hide();
                $(target+' a').hide();
            });
        </script>
        @stack('custom_scripts')
        <script>
            window.addEventListener("load", (event) => {
                document.body.classList.add('loaded');
            });

            function changeTheme() {
                if(localStorage.theme == 'dark') {
                    localStorage.theme = 'light'
                    document.documentElement.classList.remove('dark')
                } else {
                    localStorage.theme = 'dark'
                    document.documentElement.classList.add('dark')
                }
            }
            
            $('[data-action="tab-trigger"]').click(function() {
                var target = $(this).data('target');
                var tabName = $(this).data('tab');
                $('[data-tab-id="'+target+'"]>div').addClass('hidden');
                $('[data-tab-name="'+tabName+'"]').removeClass('hidden');
                $('.tab li a').removeClass('active');
                $(this).addClass('active');
            });
        </script>
    </body>
</html>
