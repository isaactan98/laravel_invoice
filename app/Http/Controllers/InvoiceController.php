<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $invoice = Invoice::where('username', '=', $user->username)->orderBy('created_at', 'desc')->get();
        return view('invoice.index', compact('user', 'invoice'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $user = auth()->user();
        return view('invoice.create', ['user' => $user]);
    }

    public function add(Request $request)
    {
        $user = auth()->user();
        $validation = null;
        $invoice = null;

        if ($request->isMethod('post')) {
            // dd($request->all());
            $validation = Validator::make($request->all(), [
                'billTo' => 'required',
                'invoiceNo' => 'required',
                'terms' => 'required',
                'billDate' => 'required'
            ])->setAttributeNames([
                'billTo' => 'Bill To',
                'invoiceNo' => 'Invoice Number',
                'terms' => 'Terms',
                'billDate' => 'Bill Date'
            ]);

            if (!$validation->fails()) {
                $table = [];
                $subtotal = 0;
                for ($i = 0; $i < count($request->input('item')); $i++) {
                    $table[$i][0] = $request->input('item')[$i];
                    $table[$i][1] = $request->input('quantity')[$i];
                    $table[$i][2] = $request->input('price')[$i];

                    $subtotal += ($table[$i][1] * $table[$i][2]);
                }

                // dd(json_encode($table));

                $discount = $request->input('discount') ?? 0;
                Invoice::create([
                    'username' => $user->username,
                    'billTo' => $request->input('billTo'),
                    'invoiceNum' => $request->input('invoiceNo'),
                    'terms' => $request->input('terms'),
                    'billDate' => $request->input('billDate'),
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'totalAmount' => $subtotal - $discount,
                    'invoice_items' => json_encode($table),
                    'remarks' => $request->input('remarks') ?? ''
                ]);

                Session::flash('success_msg', 'Added New Invoice');
                return redirect()->route('invHistory');
            }
            $invoice = (object) $request->all();
            // dd($validation);
        }
        $terms = ['' => 'Please Select Term', 'Online Banking' => 'Online Banking', 'C.O.D' => 'C.O.D', 'Others' => 'Others'];
        return view('invoice.form', [
            'user' => $user,
            'invoice' => $invoice,
            'terms' => $terms,
            'type' => 'Add',
            'route' => route('add_invoice')
        ])->withErrors($validation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username',
            'billTo',
            'invoiceNum',
            'terms',
            'billDate',
            'subtotal',
            'discount',
            'totalAmount',
            'invoice_items',
        ]);
        Invoice::create([
            'username' => $request->username,
            'billTo' => $request->billTo,
            'invoiceNum' => $request->invoiceNum,
            'terms' => $request->terms,
            'billDate' => $request->billDate,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount,
            'totalAmount' => $request->totalAmount,
            'invoice_items' => $request->invoice_items,
        ]);
        return redirect()->route('invHistory')->with('success', 'Created New Invoice');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = auth()->user();
        $invoice = Invoice::all()->where('id', '=', $id);
        foreach ($invoice as $invc) {
            $invoice = $invc;
        }
        return view('invoice.show', compact('user', 'invoice'));
    }


    public function edit(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        $user = auth()->user();
        $validation = null;

        if ($request->isMethod('post')) {
            // dd($request->all());
            $validation = Validator::make($request->all(), [
                'billTo' => 'required',
                'invoiceNo' => 'required',
                'terms' => 'required',
                'billDate' => 'required'
            ])->setAttributeNames([
                'billTo' => 'Bill To',
                'invoiceNo' => 'Invoice Number',
                'terms' => 'Terms',
                'billDate' => 'Bill Date'
            ]);

            if (!$validation->fails()) {
                $table = [];
                $subtotal = 0;
                for ($i = 0; $i < count($request->input('item')); $i++) {
                    $table[$i][0] = $request->input('item')[$i];
                    $table[$i][1] = $request->input('quantity')[$i];
                    $table[$i][2] = $request->input('price')[$i];

                    $subtotal += ($table[$i][1] * $table[$i][2]);
                }

                $discount = (int) $request->input('discount') ?? 0;

                // dd($subtotal);

                Invoice::find($id)->update([
                    'billTo' => $request->input('billTo'),
                    'invoiceNum' => $request->input('invoiceNo'),
                    'terms' => $request->input('terms'),
                    'billDate' => $request->input('billDate'),
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'totalAmount' => $subtotal - $discount,
                    'invoice_items' => json_encode($table),
                    'remarks' => $request->input('remarks') ?? ''
                ]);

                Session::flash('success_msg', 'Updated Invoice ' . $request->input('invoiceNo'));
                return redirect()->route('invHistory');
            }
            $invoice = (object) $request->all();
        }

        $terms = ['' => 'Please Select Term...', 'Online Banking' => 'Online Banking', 'C.O.D' => 'C.O.D', 'Others' => 'Others'];
        return view('invoice.form', [
            'invoice' => $invoice,
            'user' => $user,
            'terms' => $terms,
            'type' => 'Edit',
            'route' => route('edit_invoice', $id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::find($id)->delete();
        return redirect()->route('invHistory')->with('success', 'Deleted a invoice');
    }

    public function view_invoice($id)
    {
        $invoice = Invoice::find($id);
        $user = auth()->user();
        $pdf = Pdf::loadView('invoice.print', [
            'invoice' => $invoice,
            'user' => $user
        ]);

        // return $pdf->stream('Invoice #' . $invoice->invoiceNum . '.pdf');
        return view('invoice.print', [
            'invoice' => $invoice,
            'user' => $user
        ]);
    }
}
