<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Invoice App</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('head')
</head>

@yield('login')

<body class="app">
    @yield('content')

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.8.1/firebase-storage.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyDzKMA_dMPEOX5V8JuTYluMTtw_KULaWr0",
            authDomain: "testing-php-40c3e.firebaseapp.com",
            projectId: "testing-php-40c3e",
            storageBucket: "testing-php-40c3e.appspot.com",
            messagingSenderId: "362744175952",
            appId: "1:362744175952:web:082ea6b6f0d21bfe2de055",
            measurementId: "G-M975ESFREY"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        var storage = firebase.storage();
        @php $user_details = auth()->user() @endphp
        var user_details = '{!! @$user_details->username !!}';
        let profile = $('.app').find('#profile');
        // profile.attr('src', '{{ asset('images/profile-12.jpg') }}');
        storage.ref().child("public/" + user_details + "/profile_img").getDownloadURL().then((url) => {
            sessionStorage.setItem('img_url', url);
        }).catch((err) => {
            console.log(err)
        });
    </script>
    <script>
        $(document).ready(function() {
            const route = '{{ URL::current() }}';
            const location = window.location.href;
            if (location == route || location == route + '/') {
                $('a[href="' + route + '"]').addClass('side-menu--active');
                let a_tag = $('a[href="' + route + '"]');

                if (a_tag.parent().parents('ul.sub-menu').length) {
                    a_tag.parent().parent().addClass('side-menu__sub-open');
                    a_tag.parent().parent().parent().find('a.menu-title').addClass('side-menu--active');
                }
            }
        });
        if (sessionStorage.getItem('img_url')) {
            // console.log(sessionStorage.getItem('img_url'));
            $('#profile').attr('src', sessionStorage.getItem('img_url'));
        }
    </script>
    @yield('script')
</body>

</html>
