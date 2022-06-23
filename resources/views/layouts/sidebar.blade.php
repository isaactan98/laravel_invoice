@extends('layouts/app')

@section('head')
    @yield('subhead')
@endsection

@section('content')
    {{-- @include('../layout/components/mobile-menu') --}}
    <div class="mobile-menu md:hidden">
        <div class="mobile-menu-bar">
            <a href="" class="flex mr-auto">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{ asset('images/logo.svg') }}">>
            </a>
            <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2"
                    class="w-8 h-8 text-white transform -rotate-90"></i> </a>
        </div>
        <ul class="border-t border-theme-24 py-5 hidden">
            <li>
                <a href="{{ route('dashboard') }}" class="menu">
                    <div class="menu__icon"> <i data-feather="home"></i> </div>
                    <div class="menu__title"> Dashboard </div>
                </a>
            </li>
            <li>
                <a href="javascript:void(0)" class="menu menu-title">
                    <div class="menu__icon"> <i data-feather="layout"></i> </div>
                    <div class="menu__title"> Invoice <i data-feather="chevron-down"
                            class="menu__sub-icon"></i> </div>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('invHistory') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Invoice Listing </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('add_invoice') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Add Invoice </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('add_old_invoice') }}" class="menu">
                            <div class="menu__icon"> <i data-feather="activity"></i> </div>
                            <div class="menu__title"> Old Invoice </div>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    {{--  --}}
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="{{ route('dashboard') }}" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6"
                    src="{{ asset('images/logo.svg') }}">
                <span class="hidden xl:block text-white text-lg ml-3">
                    Invoice
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="side-menu menu-title">
                        <div class="side-menu__icon"> <i data-feather="layout"></i> </div>
                        <div class="side-menu__title"> Invoice <i data-feather="chevron-down"
                                class="side-menu__sub-icon"></i> </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('invHistory') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Invoice Listing </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('add_invoice') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Add Invoice </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('add_old_invoice') }}" class="side-menu">
                                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                                <div class="side-menu__title"> Old Invoice </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @include('layouts/top-bar')
            @yield('subcontent')
        </div>
        <!-- END: Content -->
    </div>
@endsection
