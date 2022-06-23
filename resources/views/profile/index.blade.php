<x-app-layout>
    @section('title', 'Profile')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @elseif ($message = Session::get('warning'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <img style="max-width: 150px;height: auto;" src="" id="profile" alt="profile" />
                    <form method="POST" id="profileDetails">
                        @csrf
                        <!-- Name -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />
                            <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{ $user['email'] }}" readonly />
                        </div>

                        <!-- Name -->
                        <div class="mt-4">
                            <x-label for="name" :value="__('Name')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user['name'] }}" readonly />
                        </div>

                        <!--  -->
                        <div class="mt-4">
                            <x-label for="username" :value="__('Username')" />
                            <x-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{ $user['username'] }}" readonly />
                        </div>

                        <!--  -->
                        <div class="mt-4">
                            <x-label for="phone" :value="__('Phone Number')" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $user['phone'] }}" readonly />
                        </div>

                        <!--  -->
                        <div class="mt-4">
                            <x-label for="website" :value="__('Website')" />
                            <x-input id="website" class="block mt-1 w-full" type="text" name="website" value="{{$user['website']}}" readonly />
                        </div>

                        <!--  -->
                        <div class="mt-4">
                            <x-label for="bankName" :value="__('Bank Name')" />
                            <x-input id="bankName" class="block mt-1 w-full" type="text" name="bankName" value="{{$user['bankName']}}" readonly />
                        </div>

                        <!--  -->
                        <div class="mt-4">
                            <x-label for="bankAcc" :value="__('Bank Account')" />
                            <x-input id="bankAcc" class="block mt-1 w-full" type="text" name="bankAcc" value="{{$user['bankAcc']}}" readonly />
                        </div>

                    </form>
                    <div class="flex items-center justify-end mt-4">
                        <a href="/profile_img" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ml-4">{{__('Image')}}</a>
                        <a href="/editProfile" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium ml-4">
                            {{ __('Edit') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
    <?php
    $userDetail = auth()->user();
    ?>
    storage.ref().child("public/{{$userDetail['username']}}/profile_img").getDownloadURL().then((url) => {
        var img = document.getElementById('profile');
        img.setAttribute('src', url);
    }).catch((err) => {
        console.log(err)
    });
</script>