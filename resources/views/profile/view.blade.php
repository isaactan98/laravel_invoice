@extends('layouts/sidebar')
@section('title', 'Profile Detail')

@section('head')
    <style>
        #change_img {
            cursor: pointer;
        }

    </style>
@endsection

@section('breadcrumb')
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">Profile</a>
    </div>
    <!-- END: Breadcrumb -->
@endsection

@section('subcontent')
    <div class="intro-y box px-5 pt-5 mt-5">
        <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
            <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                    <img alt="Profile IMG" id="profile_img" class="rounded-full">
                    <button
                        class="absolute mb-1 mr-1 flex items-center justify-center bottom-0 right-0 bg-theme-1 rounded-full p-2"
                        id="change_img">
                        <i class="w-4 h-4 text-white" data-feather="camera"></i></button>
                </div>
                <div class="ml-5">
                    <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{ $user->name }}</div>
                    <div class="text-gray-600">{{ $user->username }}</div>
                </div>
            </div>
            <div
                class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
                <div class="truncate sm:whitespace-normal flex items-center">
                    <i data-feather="mail" class="w-4 h-4 mr-2"></i> {{ $user->email }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                    <i data-feather="phone" class="w-4 h-4 mr-2"></i> {{ $user->phone }}
                </div>
                <div class="truncate sm:whitespace-normal flex items-center mt-3">
                    <i data-feather="compass" class="w-4 h-4 mr-2"></i>
                    <a href="{{ $user->website }}" target="_blank" rel="noopener noreferrer">{{ $user->website }}</a>
                </div>
            </div>
            <div
                class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                <div class="text-center rounded-md w-20 py-3">
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">201</div>
                    <div class="text-gray-600">Orders</div>
                </div>
                <div class="text-center rounded-md w-20 py-3">
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">1k</div>
                    <div class="text-gray-600">Purchases</div>
                </div>
                <div class="text-center rounded-md w-20 py-3">
                    <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">492</div>
                    <div class="text-gray-600">Reviews</div>
                </div>
            </div>
        </div>
        <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start">
            <a data-toggle="tab" data-target="#dashboard" href="javascript:;" class="py-4 sm:mr-8 active">Dashboard</a>
            <a data-toggle="tab" data-target="#account-and-profile" href="javascript:;" class="py-4 sm:mr-8">Account &
                Profile</a>
            {{-- <a data-toggle="tab" data-target="#activities" href="javascript:;" class="py-4 sm:mr-8">Activities</a>
            <a data-toggle="tab" data-target="#tasks" href="javascript:;" class="py-4 sm:mr-8">Tasks</a> --}}
        </div>
    </div>
    <div class="intro-y tab-content mt-5">
        <div class="tab-content__pane active" id="dashboard">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Top Categories -->
                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Top Categories
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content__pane" id="account-and-profile">
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Top Categories -->
                <div class="intro-y box col-span-12 xl:col-span-12">
                    <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Personal Information
                        </h2>
                    </div>
                    <form action="{{ route('profile') }}" method="POST">
                        @csrf
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-6 lg:col-span-6">
                                    <div>
                                        <label>Email</label>
                                        <input type="email" class="input w-full border bg-gray-100 cursor-not-allowed mt-2"
                                            placeholder="Input text" value="{{ $user->email }}" disabled>
                                    </div>
                                    <div class="mt-3">
                                        <label>Username</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Input text"
                                            value="{{ $user->username }}" disabled>
                                    </div>
                                    <div class="mt-3">
                                        <label>Name</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Input text"
                                            value="{{ $user->name }}" name="name">
                                    </div>
                                    <div class="mt-3">
                                        <label>Phone Number</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Input text"
                                            value="{{ $user->phone }}" name="phone">
                                    </div>
                                </div>
                                <div class="col-span-6 xl:col-span-6">
                                    <div>
                                        <label>Website</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Input text"
                                            value="{{ $user->website }}" name="website">
                                    </div>
                                    <div class="mt-3">
                                        <label>Bank Name</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Input text"
                                            value="{{ $user->bankName }}" name="bankName">
                                    </div>
                                    <div class="mt-3">
                                        <label>Bank Account</label>
                                        <input type="text" class="input w-full border mt-2" placeholder="Input text"
                                            value="{{ $user->bankAcc }}" name="bankAcc">
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                {{-- <a href="" class="text-theme-6 flex items-center"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete Account </a> --}}
                                <button type="submit" class="button w-20 bg-theme-1 text-white ml-auto">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#profile_img').attr('src', sessionStorage.getItem('img_url'));

        $('#change_img').on('click', function() {
            window.location.href = '{{ route('profile_image') }}';
        });
    </script>
@endsection
