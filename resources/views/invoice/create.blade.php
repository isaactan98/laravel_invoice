@extends('layouts/sidebar')

@section('heaed')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
@endsection

@section('breadcrumb')
    <!-- BEGIN: Breadcrumb -->
    <div class="-intro-x breadcrumb mr-auto hidden sm:flex">
        <a href="" class="">Application</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="">Invoice</a>
        <i data-feather="chevron-right" class="breadcrumb__icon"></i>
        <a href="" class="breadcrumb--active">Add</a>
    </div>
    <!-- END: Breadcrumb -->
@endsection

@section('title') Old Add Invoice @endsection

@section('subcontent')
    <?php $user = auth()->user(); ?>
    <div id="invoice">
        <table id="company">
            <tbody>
                <tr>
                    <td>
                        <img id="inv_profile" src="" alt="profile" />
                    </td>
                    <td class="right">
                        <div>{{ $user['name'] }}</div>
                        <div>Phone: {{ $user['phone'] }}</div>
                        <div>
                            <a target="_blank" href="{{ $user['website'] }}">{{ $user['website'] }}</a>
                        </div>
                        <div>{{ $user['email'] }}</div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="bigi">SALES INVOICE</div>
        <form method="POST" action="">
            @csrf
            <input type="hidden" name="username" value="{{ $user['username'] }}" />
            <table id="billship">
                <tbody>
                    <tr>
                        <td>
                            Bill to:
                            <textarea name="billTo" id="customer-title"></textarea>
                        </td>
                        <td></td>
                        <td class="invc">
                            <div>
                                <strong>Invoice #:</strong>
                                <textarea name="invoiceNum">INV-20120001</textarea>
                            </div>
                            <div>
                                <strong>Terms:</strong><br />
                                <select name="terms" class="terms">
                                    <option>C.O.D</option>
                                    <option>Online Banking</option>
                                    <option>Others</option>
                                </select>
                            </div>
                            <br />
                            <div>
                                <strong>Date:</strong>
                                <textarea name="billDate" id="date">December 15, 2009</textarea>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table id="items">
                <tbody>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                    </tr>
                    <tr class="item-row">
                        <td class="item-name">
                            <div class="delete-wpr">
                                <textarea>Rubber Hose</textarea>
                                <input type="button" class="delete" value="X" />
                            </div>
                        </td>
                        <td><textarea class="qty">3</textarea></td>
                        <td><textarea class="cost">5.50</textarea></td>
                        <td><span class="price">$16.50</span></td>
                    </tr>
                    <tr class="item-row">
                        <td class="item-name">
                            <div class="delete-wpr">
                                <textarea>Rubber Hose</textarea>
                                <input type="button" class="delete" value="X" />
                            </div>
                        </td>
                        <td><textarea class="qty">3</textarea></td>
                        <td><textarea class="cost">5.50</textarea></td>
                        <td><span class="price">$16.50</span></td>
                    </tr>
                    <tr id="hiderow">
                        <td colspan="5">
                            <!-- <a id="addrow" href="javascript:;" title="Add a row">Add a row</a> -->
                            <input type="button" id="addrow" title="Add a Row" value="Add a row" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--  -->
            <table id="totalTable">
                <tbody>
                    <tr>
                        <td class="totalName"></td>
                        <td class="totalName"></td>
                        <td class="totalName"></td>
                        <td></td>
                    </tr>
                    <tr class="ttl">
                        <td class="right" colspan="3">SUB-TOTAL</td>
                        <td class="total-value">
                            <div id="subtotal">$</div>
                            <input type="hidden" id="subtotal" value="" name="subtotal" />
                        </td>
                    </tr>
                    <tr class="ttl" id="no">
                        <td class="right" colspan="3">SUB-TOTAL</td>
                        <td class="total-value">
                            <div id="total">$875.00</div>
                        </td>
                    </tr>
                    <tr class="ttl">
                        <td class="right" colspan="3">DISCOUNT</td>
                        <td class="total-value"><textarea name="discount" id="paid">$0.00</textarea></td>
                    </tr>
                    <tr class="ttl">
                        <td class="right" colspan="3">GRAND TOTAL</td>
                        <td class="total-value balance">
                            <div class="due">$</div>
                            <input type="hidden" id="totalAmount" value="" name="totalAmount" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" value="" name="invoice_items" id="inItems" readonly />
            <div class="flex items-center justify-end mt-4">
                <x-button id="button" class="ml-4">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
        <div class="flex items-center justify-end mt-4">
            <button id="button"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4"
                onclick="printPDF()">Print</button>
        </div>
        <div id="notes">
            <h4>Bank Details</h4>
            <h5>Bank: {{ $user['bankName'] }}</h5>
            <h5>Account No: {{ $user['bankAcc'] }}</h5>
            <br />
            <p>*This is a computer generated receipt no signature required.</p>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/js.js') }}"></script>
    <script>
        $(document).change(function() {
            var myTableArray = [];
            $("table#items tr").each(function() {
                var arrayOfThisRow = [];
                var tableData = $(this).find("td textarea");
                if (tableData.length > 0) {
                    tableData.each(function() {
                        arrayOfThisRow.push($(this).val());
                    });
                    myTableArray.push(arrayOfThisRow);
                }
            });
            //alert(myTableArray[0][0]);
            console.log(myTableArray);
            $("#inItems").val(JSON.stringify(myTableArray));
        });
    </script>
    <script>
        function printPDF() {
            window.print();
        }

        $('#inv_profile').attr('src', sessionStorage.getItem('img_url'));
    </script>
@endsection
