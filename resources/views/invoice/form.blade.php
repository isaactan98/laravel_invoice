@extends('layouts/sidebar')
@section('title', $type . ' New Invoice')

@section('head')
    <style>
        .h-80 {
            height: 80%;
        }

    </style>
@endsection

@section('breadcrumb')
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="{{ route('invHistory') }}" class="">Invoice</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">{{ $type }}</a>
    </div>
    <!-- END: Breadcrumb -->
@endsection

@section('subcontent')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @enderror

    <form action="{{ $route }}" method="post">
        @csrf
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Customer Details
                        </h2>
                    </div>
                    <div class="p-5" id="input">
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 lg:col-span-6">
                                <label for="">Bill To: </label>
                                <textarea name="billTo" id="" class="input border w-full h-80"
                                    required>{{ @$invoice->billTo }}</textarea>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <div>
                                    <label>Invoice No:</label>
                                    <input type="text" class="input w-full border mt-2" placeholder="Invoice No#"
                                        name="invoiceNo" value="{{ @$invoice->invoiceNum }}" id="auto-invoice"
                                        required>
                                    <div class="text-xs text-gray-600 mt-2">Auto Generate or Type In</div>
                                </div>
                                <div class="mt-3">
                                    <label for="">Terms: </label>
                                    <select class="tail-select w-full" name="terms">
                                        @if ($type == 'Edit')
                                            @foreach ($terms as $key => $t)
                                                <option value="{{ $key }}" @if (@$invoice->terms == $key) selected @endif>
                                                    {{ $t }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">Please Select Terms</option>
                                            <option value="Online Banking">Online Banking</option>
                                            <option value="C.O.D">C.O.D</option>
                                            <option value="Others">Others</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="">Date: </label>
                                    <div class="relative">
                                        <div
                                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                                            <i data-feather="calendar" class="w-4 h-4"></i>
                                        </div>
                                        <input type="text" class="datepicker input pl-12 border" data-single-mode="true"
                                            name="billDate" value="{{ @$invoice->billDate }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box intro-y mt-3">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200 dark:border-dark-5">
                        <h2 class="font-medium text-base mr-auto">
                            Items Details
                        </h2>
                        @if ($type != 'Edit')
                            <button id="additem"
                                class="button w-24 button--sm inline-block mr-1 mb-2 border border-theme-1 text-theme-1 dark:border-theme-10 dark:text-theme-10">
                                Add Item
                            </button>
                        @endif
                    </div>
                    <div class="overflow-x-auto m-2">
                        <table class="table">
                            <thead class="">
                                <tr class="bg-gray-200 text-gray-700">
                                    <th class="whitespace-no-wrap">Item</th>
                                    <th class="whitespace-no-wrap">Quantity</th>
                                    <th class="whitespace-no-wrap">Price</th>
                                    <th class="whitespace-no-wrap">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($type == 'Edit')
                                    @php $items = json_decode($invoice->invoice_items) @endphp
                                    @for ($i = 0; $i < count($items); $i++)
                                        <tr id="{{ $i }}">
                                            <td>
                                                <input type="text" name="item[]" id="iv0{{ $i }}"
                                                    value="{{ $items[$i][0] }}" class="input border min-w-full">
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" id="q0{{ $i }}"
                                                    class="input w-32 border" value="{{ $items[$i][1] }}">
                                            </td>
                                            <td>
                                                <input type="number" name="price[]" id="p0{{ $i }}"
                                                    class="input w-32 border" value="{{ $items[$i][2] }}">
                                            </td>
                                            <td>RM
                                                <span
                                                    id="total0{{ $i }}">{{ $items[$i][1] * $items[$i][2] }}</span>
                                                <input type="hidden" id="t0{{ $i }}" class="tt">
                                            </td>
                                        </tr>
                                    @endfor
                                @else
                                    <tr id="insertbefore"></tr>
                                @endif
                                <tr>
                                    <td colspan="3" class="text-right">Subtotal:</td>
                                    <td>RM <span id="subtotal">{{ @$invoice->subtotal }}</span></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Discount: </td>
                                    <td><input type="tel" name="discount" class="input border w-24" id="discount"
                                            value="{{ @$invoice->discount }}" required></td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">Total:</td>
                                    <td class="bold">RM <span
                                            id="grandtotal">{{ @$invoice->totalAmount }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box intro-y mt-3">
                    <div class="p-5">
                        <div>
                            <label for="">Remarks: </label>
                            <textarea name="remarks" id=""
                                class="input border w-full h-full">{{ @$invoice->remarks }}</textarea>
                        </div>
                        <div class="pt-3 flex justify-end">
                            <button class="button bg-theme-1 text-white button-apply" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script>
        // 
        let count = 0;
        let product_subtotal_arr = [];
        let discount = 0;
        // 

        // 
        $(document).ready(function() {

            const date = new Date();
            let month = '0' + (date.getMonth() + 1).length > 3 ? date.getMonth() + 1 : '0' + (date.getMonth() + 1);
            let year = date.getFullYear().toString();
            $('#auto-invoice').val('INV-' + year.substring(2) + month + '001');

        });

        $('#additem').click(function(e) {
            e.preventDefault();
            let add = '';
            add += '<tr id="' + count + '">';
            add += '<td><input type="text" name="item[]" class="input w-full border" id="iv0' + count +
                '" autocomplete="off"></td>';
            add += '<td><input type="number" name="quantity[]" class="input w-32 border quan" id="q0' + count +
                '" autocomplete="off"></td>';
            add += '<td><input type="number" name="price[]" class="input w-32 border price" id="p0' + count +
                '" autocomplete="off"></td>';
            add += '<td>RM <span id="total0' + count + '"></span><input type="hidden" id="t0' + count +
                '" class="tt"></td>';
            add += '</tr>';
            count++;

            $(add).insertBefore('#insertbefore');
            $('input[type="number"]').on('keyup', function() {
                let id = $(this).attr('id');
                let price = 0;
                let quantity = 0;
                let subs = id.substring(0, 1);

                if (subs == 'p') {
                    price = $(this).val();
                    quantity = $('#q' + id.substring(1)).val() ?? 0;
                } else {
                    price = $('#p' + id.substring(1)).val() ?? 0;
                    quantity = $(this).val();
                }

                let total = parseFloat(price * quantity).toFixed(2);
                $('#total' + id.substring(1)).html(total);
                $('#t' + id.substring(1)).val(total);
                subtotal();
                grandtotal();
            });
        });

        $('input[type="number"]').on('keyup', function() {
            let id = $(this).attr('id');
            let price = 0;
            let quantity = 0;
            let subs = id.substring(0, 1);

            if (subs == 'p') {
                price = $(this).val();
                quantity = $('#q' + id.substring(1)).val() ?? 0;
            } else {
                price = $('#p' + id.substring(1)).val() ?? 0;
                quantity = $(this).val();
            }

            let total = parseFloat(price * quantity).toFixed(2);
            $('#total' + id.substring(1)).html(total);
            $('#t' + id.substring(1)).val(total);
            subtotal();
            grandtotal();
        });

        function subtotal() {
            product_subtotal_arr = $('.tt').map((_, el) => el.value).get();
            let sum = product_subtotal_arr.reduce((p, c) => {
                return p + (parseFloat(c) || 0);
            }, 0);
            $('#subtotal').html(sum.toFixed(2));
        }

        $('#discount').on('keyup', function() {
            discount = $(this).val();
            grandtotal();
        });

        function grandtotal() {
            if (discount != 0) {
                product_subtotal_arr = $('.tt').map((_, el) => el.value).get();
                let sum = product_subtotal_arr.reduce((p, c) => {
                    return p + (parseFloat(c) || 0);
                }, 0);
                let grandtt = sum - discount;
                $('#grandtotal').html(grandtt.toFixed(2));
            } else {
                product_subtotal_arr = $('.tt').map((_, el) => el.value).get();
                let sum = product_subtotal_arr.reduce((p, c) => {
                    return p + (parseFloat(c) || 0);
                }, 0);
                $('#grandtotal').html(sum.toFixed(2));
            }
        }
    </script>
@endsection
