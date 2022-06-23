<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="container">
                <!-- BEGIN: Error Page -->
                <div class="error-page flex flex-col lg:flex-row items-center justify-center h-screen text-center lg:text-left">
                    <div class="-intro-x lg:mr-20">
                        <img alt="Midone Tailwind HTML Admin Template" class="h-48 lg:h-auto" src="/images/error-illustration.svg">
                    </div>
                    <div class="text-white mt-10 lg:mt-0">
                        <div class="intro-x text-6xl font-medium">@yield('code')</div>
                        <div class="intro-x text-xl lg:text-3xl font-medium">Oops. @yield('message').</div>
                        <div class="intro-x text-lg mt-3">You may have mistyped the address or the page may have moved.</div>
                    </div>
                </div>
                <!-- END: Error Page -->
            </div>
        </div>
    </body>
</html>
