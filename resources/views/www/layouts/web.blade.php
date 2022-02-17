<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#06455e">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <!-- <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png"> -->
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-P226HL4B0H"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-P226HL4B0H');
        </script>

        <title>@hasSection('title') @yield('title') - @endif{{ config('app.name') }}</title>

        <!-- CSS here -->
        @include('www.layouts.partials.styles')
        @yield('page-styles')
    </head>
    <body>
        <!-- preloader -->
        <!-- preloader-end -->

        <!-- header-area -->
        <header class="third-header-bg">
            @include('www.layouts.partials.header')
        </header>
        <!-- header-area-end -->

        <!-- main-area -->
        <main>
            @yield('content')
        </main>
        <!-- main-area-end -->

        <!-- footer-area -->
        <footer>
            @include('www.layouts.partials.footer')
        </footer>
        <!-- footer-area-end -->

        <!-- JS here -->
        @include('www.layouts.partials.scripts')
        @yield('page-scripts')
    </body>
</html>
