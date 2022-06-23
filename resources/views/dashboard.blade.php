@extends('layouts/sidebar')

@section('title', 'Dashboard')

@section('breadcrumb')
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">Dashboard</a>
    </div>
    <!-- END: Breadcrumb -->
@endsection

@section('subcontent')
    <div class="grid">
        <div class="container p-10 rounded-lg shadow-lg bg-gray-300 mt-5 -intro-y">
            <h1>Welcome back! {{ auth()->user()->name }}</h1>
        </div>
    </div>
@endsection
