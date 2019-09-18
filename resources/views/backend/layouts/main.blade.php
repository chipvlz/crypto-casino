<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('backend.includes.head')
</head>
<body class="backend {{ str_replace('.','-',Route::currentRouteName()) }} theme-{{ config('settings.theme') }}">
    @includeWhen(config('settings.gtm_container_id'), 'frontend.includes.gtm-body')

    <div id="app">

        <div class="container-fluid bg-primary">
            @include('backend.includes.header')
        </div>

        <div class="container">

            <div class="mt-2">
                @message
                @endmessage
            </div>

            <div id="content" class="bg-secondary mt-3">
                <div class="row">
                    <div class="col">
                        <h1 class="mb-3">
                            @yield('title')
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>

        @include('backend.includes.footer')

    </div>

    @include('backend.includes.scripts')

</body>
</html>