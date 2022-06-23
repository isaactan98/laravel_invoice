<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://css-tricks.com/examples/EditableInvoice/js/jquery-1.3.2.min.js"></script>

    <title>Invoice</title>
</head>

<body data-new-gr-c-s-check-loaded="14.990.0" data-gr-ext-installed="">
    <div id="invoice">
        <table id="company">
            <tbody>
                <tr>
                    <td>
                        <img src="" id="profile" alt="profile" />
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

        @csrf
        <input type="hidden" name="username" value="{{ $user['username'] }}" />
        <table id="billship">
            <tbody>
                <tr>
                    <td>
                        Bill to:
                        <textarea name="billTo" readonly id="customer-title">{{ $invoice['billTo'] }}</textarea>
                    </td>
                    <td></td>
                    <td class="invc">
                        <div>
                            <strong>Invoice #:</strong>
                            <textarea readonly name="invoiceNum">{{ $invoice['invoiceNum'] }}</textarea>
                        </div>
                        <div>
                            <strong>Terms:</strong><br />
                            <select name="terms" class="terms">
                                <option>{{ $invoice->terms }}</option>
                            </select>
                        </div>
                        <br />
                        <div>
                            <strong>Date:</strong>
                            <textarea readonly name="billDate">{{ $invoice->billDate }}</textarea>
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
                <?php $items = json_decode($invoice->invoice_items); ?>
                @for ($i = 0; $i < count($items); $i++)
                    <tr class="item-row">
                        <td class="item-name">
                            {{ $items[$i][0] }}
                        </td>
                        <td>{{ $items[$i][1] }}</td>
                        <td>{{ $items[$i][2] }}</td>
                        <td><span class="price" id="itemPrice"></span></td>
                    </tr>
                @endfor
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
                        <div id="subtotal">${{ $invoice->subtotal }}</div>
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
                    <td class="total-value"><textarea name="discount"
                            id="paid">{{ $invoice->discount }}</textarea></td>
                </tr>
                <tr class="ttl">
                    <td class="right" colspan="3">GRAND TOTAL</td>
                    <td class="total-value balance">
                        <div class="">$ {{ $invoice->totalAmount }}</div>
                        <input type="hidden" id="totalAmount" value="" name="totalAmount" />
                    </td>
                </tr>
            </tbody>
        </table>
        <input type="hidden" value="" name="invoice_items" id="inItems" readonly />
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
    <script>
        $(document).ready(function() {
            var table = document.getElementById("items");
            var rows = table.getElementsByTagName("tr");
            var totalRowCount = 0;
            var rowCount = 0;
            for (var i = 1; i < rows.length; i++) {
                totalRowCount++;
                if (rows[i].getElementsByTagName("td").length > 0) {
                    rowCount++;
                    $total = table.rows[i].cells[1].innerHTML * table.rows[i].cells[2].innerHTML;
                    table.rows[i].cells[3].innerHTML = "$ " + $total.toFixed(2);
                }
            }
        });
    </script>
    <script>
        function printPDF() {
            window.print();
        }
    </script>
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
        <?php $userDetail = auth()->user(); ?>
        storage.ref().child("public/{{ $userDetail['username'] }}/profile_img").getDownloadURL().then((url) => {
            var img = document.getElementById('profile');
            img.setAttribute('src', url);
        }).catch((err) => {
            console.log(err)
        });
    </script>

</body>

</html>
