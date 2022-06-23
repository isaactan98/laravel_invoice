@extends('layouts/sidebar')
<?php $user = auth()->user(); ?>
@section('title', 'Invoice List')

@section('breadcrumb')
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">Invoice</a>
    </div>
    <!-- END: Breadcrumb -->
@endsection

@section('subcontent')
    <div class="sm:px-6 lg:px-8 -mb-3">
        @if (Session::has('success_msg'))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9">
                {{ Session::get('success_msg') }}
            </div>
        @endif
        @if ($message = Session::has('error_msg'))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6">
                {{ Session::get('error_msg') }}
            </div>
        @endif
    </div>

    <div class="flex flex-col py-6 intro-y">
        <div class="-my-2 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        #</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Invoice</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bill To</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($invoice as $inv)
                                    <tr>
                                        <td class="px-6 py-4 ">{{ ++$i }}</td>
                                        <td class="px-6 py-4 ">{{ $inv->invoiceNum }}</td>
                                        <td class="px-6 py-4 ">{{ $inv->billTo }}</td>
                                        <td class="px-6 py-4 ">{{ $inv->totalAmount }}</td>
                                        {{-- <td class="px-6 py-4 ">
                                            <a class="button button--sm w-24 inline-block mr-1 mb-2 bg-theme-1 text-white"
                                                href="/invoice/edit/{{ $inv->id }}">View</a>
                                            <a class="button button--sm w-24 inline-block mr-1 mb-2 bg-theme-6 text-white"
                                                href="/delete/{{ $inv->id }}"
                                                onclick="return confirm('Are you sure?')">Delete</a>
                                        </td> --}}
                                        <td>
                                            <div class="flex justify-center items-center">
                                                <a class="flex items-center mr-3"
                                                    href="/invoice/edit/{{ $inv->id }}"><i data-feather="check-square"
                                                        class="w-4 h-4 mr-1"></i> Edit</a>
                                                <a class="flex items-center mr-3 text-theme-10" target="_blank"
                                                    href="/invoice/view/{{ $inv->id }}"><i data-feather="file-minus"
                                                        class="w-4 h-4 mr-1"></i> View</a>
                                                <a class="flex items-center mr-3 text-theme-6"
                                                    href="/delete/{{ $inv->id }}"
                                                    onclick="return confirm('Are you sure?')"><i data-feather="trash-2"
                                                        class="w-4 h-4 mr-1"></i> Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
