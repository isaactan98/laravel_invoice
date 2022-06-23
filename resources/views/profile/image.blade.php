@extends('layouts/sidebar')
<?php $user = auth()->user(); ?>
@section('title', 'Profile Image')

@section('breadcrumb')
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb">Profile</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">Image</a>
    </div>
    <!-- END: Breadcrumb -->
@endsection

@section('subcontent')

    <div class="intro-y box px-5 pt-5 mt-5">
        <input type="file" name="profile_image" id="profile_img" />
        <progress value="0" max="100" id="progresser">0%</progress>

        <img src="" id="old_profile" alt="profile" />

    </div>

@endsection

@section('script')
    <script>
        var profile_img = document.getElementById('profile_img');
        var progresser = document.getElementById('progresser');


        profile_img.addEventListener('change', function(e) {
            var file = e.target.files[0];

            var upload = storage.ref("public/{{ $user['username'] }}/profile_img");

            var task = upload.put(file);

            task.on('state_change',
                function progress(snapshot) {
                    var percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    progresser.value = percentage;
                },
                function error(err) {},
                function success() {
                    location.reload();
                }
            );
        });

        var img = document.getElementById('old_profile');
        img.setAttribute('src', sessionStorage.getItem('img_url'));
    </script>
@endsection
