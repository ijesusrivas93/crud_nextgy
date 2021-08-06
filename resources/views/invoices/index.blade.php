@extends('products.layout')
 
@section('content')
    <div class="row" style="margin-top: 5rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Facturas</h2>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Estado</th>
            <th>Tipo de pago</th>
            <th width="280px">Action</th>
        </tr>
        
            @foreach ($invoices as $invoice)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $invoice->name }}</td>
                <td>{{ $invoice->total }}</td>
                <td>{{ $invoice->created_at }}</td>
                <td>{{ $invoice->status }}</td>
                <td>{{ $invoice->payment_type }}</td>                
                <td>
                    <form action="{{route('invoices.update',$invoice->id)}}" method="POST">    
                        @csrf
                        @method('PUT')                        
                        <button type="submit" style="@if($invoice->status == 'Cancelada') display:none @endif" class="btn btn-danger">Cancelar</button>
                    </form>
                </td>                
            </tr>
            @endforeach
    </table>
@endsection