@extends('master-no-nav')
@section('title', 'Invoice #' . $invoice->invoiceNum)
@section('head')
    <style>
        @media print {
            .print-hide {
                display: none
            }

            .w-30 {
                width: 100% !important;
            }
        }
        @media screen and (max-width: 650px){
            .w-30 {
                width: 100%;
            }
        }
    </style>
@endsection
@section('content')
    <div class="box mt-5 w-1/3 w-30" id="print_this">
        <div class="flex flex-row pt-10 px-5 pb-10 text-center">
            <div class="font-semibold text-theme-1 dark:text-theme-10 text-3xl">INVOICE</div>
            <div class="mt-0 ml-auto text-right">
                <div class="text-xl text-theme-1 dark:text-theme-10 font-medium">{{ $user->name }}</div>
                <div class="mt-1">{{ $user->email }}</div>
                <div class="mt-1">{{ $user->phone }}</div>
                <div class="mt-1">{{ $user->website }}</div>
                {{-- <div class="mt-1">8023 Amerige Street Harriman, NY 10926.</div> --}}
            </div>
        </div>
        <div class="flex flex-row pt-5 px-5 pb-10">
            <div>
                <div class="text-base text-gray-600">Client Details</div>
                {{-- <div class="text-lg font-medium text-theme-1 dark:text-theme-10 mt-2">Arnold Schwarzenegger</div> --}}
                <div class="mt-1 w-3/4">{{ $invoice->billTo }}</div>
                {{-- <div class="mt-1">260 W. Storm Street New York, NY 10025.</div> --}}
            </div>
            <div class="mt-0 ml-auto text-right w-2/3">
                <div class="text-base text-gray-600">Receipt</div>
                <div class="text-lg text-theme-1 dark:text-theme-10 font-medium mt-2">{{ $invoice->invoiceNum }}</div>
                <div class="mt-1">{{ $invoice->billDate }}</div>
            </div>
        </div>
        <div class="px-5 sm:px-16 py-5 sm:py-5">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-5 whitespace-no-wrap">DESCRIPTION</th>
                            <th class="border-b-2 dark:border-dark-5 text-right whitespace-no-wrap">QTY</th>
                            <th class="border-b-2 dark:border-dark-5 text-right whitespace-no-wrap">PRICE</th>
                            <th class="border-b-2 dark:border-dark-5 text-right whitespace-no-wrap">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (json_decode($invoice->invoice_items) as $key => $item)
                            <tr>
                                <td class="border-b dark:border-dark-5">
                                    <div class="font-medium whitespace-no-wrap">{{ $item[0] }}</div>
                                    {{-- <div class="text-gray-600 text-xs whitespace-no-wrap">Regular License</div> --}}
                                </td>
                                <td class="text-right border-b dark:border-dark-5 w-32">{{ $item[1] }}</td>
                                <td class="text-right border-b dark:border-dark-5 w-32">{{ $item[2] }}</td>
                                <td class="text-right border-b dark:border-dark-5 w-32 font-medium">
                                    {{ $item[1] * $item[2] }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="text-right border-b dark:border-dark-5 w-32" colspan="3">Subtotal : </td>
                            <td class="text-right border-b dark:border-dark-5 w-32 font-medium">{{ $invoice->subtotal }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right border-b dark:border-dark-5 w-32" colspan="3">Discount : </td>
                            <td class="text-right border-b dark:border-dark-5 w-32 font-medium">
                                {{ $invoice->discount ?? 0 }}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right border-b dark:border-dark-5 w-32" colspan="3">Total : </td>
                            <td class="text-right border-b dark:border-dark-5 w-32 font-medium">
                                {{ $invoice->totalAmount }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if (@$invoice->remarks)    
        <div class="px-5 pb-5 ">
            <div>
                <h3>Remarks</h3>
                <textarea name="remarks" id="" class="input border w-full h-full">{{ @$invoice->remarks }}</textarea>
            </div>
        </div>
        @endif
        <div class="px-5 pb-10 flex justify-between">
            <div class="text-left mt-10">
                <div class="text-base text-gray-600">Bank Transfer</div>
                <div class="text-lg text-theme-1 dark:text-theme-10 font-medium mt-2">{{ $user->name }}</div>
                <div class="mt-1">Bank Name : {{ $user->bankName }}</div>
                <div class="mt-1">Bank Account : {{ $user->bankAcc }}</div>
            </div>
            <div class="text-right mt-10">
                <div class="text-base text-gray-600">Total Amount</div>
                <div class="text-xl text-theme-1 dark:text-theme-10 font-medium mt-2">RM {{ $invoice->totalAmount }}
                </div>
            </div>
        </div>
    </div>
    <div class="box mt-3 flex justify-end print-hide items-center">
        <div class="m-5">
            <button class="button bg-theme-1 text-white" type="button" id="print">Print</button>
        </div>

    </div>
@endsection
@section('script')
    <script>
        $('#print').click(function() {
            window.print();
            // $('#print_this').print();
        })
    </script>
@endsection
