<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<x-app-layout>
    @section('title', 'Update Profile')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" id="profileDetails" action="{{ route('profile') }}">
                        @csrf
                        <input type="hidden" value="{{$users->email}}" name="email" readonly>

                        <!-- Name -->
                        <div>
                            <x-input id="name" class="block mt-1 w-full" type="hidden" name="name" value="{{ $users->name }}" readonly />
                        </div>

                        <!--  -->
                        <div>
                            <x-input id="username" class="block mt-1 w-full" type="text" name="username" value="{{ $users['username'] }}" aria-readonly="true" />
                        </div>

                        <!--  -->
                        <div>
                            <x-label for="phone" :value="__('Phone Number')" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $users['phone'] }}" required />
                        </div>

                        <!--  -->
                        <div>
                            <x-label for="website" :value="__('Website')" />
                            <x-input id="website" class="block mt-1 w-full" type="text" name="website" value="{{$users['website']}}" required />
                        </div>

                        <!--  -->
                        <div>
                            <x-label for="bankName" :value="__('Bank Name')" />
                            <x-input id="bankName" class="block mt-1 w-full" type="text" name="bankName" value="{{$users['bankName']}}" required />
                        </div>

                        <!--  -->
                        <div>
                            <x-label for="bankAcc" :value="__('Bank Account')" />
                            <x-input id="bankAcc" class="block mt-1 w-full" type="text" name="bankAcc" value="{{$users['bankAcc']}}" required />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-button id="proceed" class="ml-4">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>