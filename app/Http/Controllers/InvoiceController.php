<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = Invoice::with('client','payment')->get();

        //$clients = Client::with('invoices')->latest()->paginate(5);
        $invoices = Invoice::join('payments','invoices.payment_id','=','payments.id')->join('clients','clients.id','=','invoices.client_id')->get(['invoices.id','clients.name','invoices.total','invoices.status','invoices.created_at','payments.payment_type']);

        //$invoices = Invoice::with('clients','payments')->latest()->paginate(5);

        return view('invoices.index',compact('invoices'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'client_id' => 'required',
            'payment_id' => 'required',
            //'total' => 'required',
        ]);
    
        Invoice::create($request->all());
     
        return redirect()->route('invoices.index')
                        ->with('success','Factura creada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
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
        $invoice->status = "Cancelada";
        $invoice->save();
    
        return redirect()->route('invoices.index')
                        ->with('success','Factura actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
