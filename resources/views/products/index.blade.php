@extends('products.layout')
 
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Agregar nuevo producto</h2>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('products.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                <input type="text" name="title" class="form-control" placeholder="Ingresa el nombre">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Cantidad:</strong>
                <input type="number" name="quantity" class="form-control" placeholder="Cantidad">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Precio:</strong>
                <input type="number" name="price" class="form-control" placeholder="Valor">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Añadir producto</button>
        </div>
    </div>
   
</form>


   
 


<div class="row" style="margin-top: 5rem;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Productos</h2>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
   
        <table class="table table-bordered">
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th width="280px">Action</th>
            </tr>
                
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->quantity }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ ($value->quantity)*($value->price) }}</td>
                    <td>
                        <form action="{{ route('products.destroy',$value->id) }}" method="POST">   
                            <a class="btn btn-info" href="{{ route('products.show',$value->id) }}">Show</a>  
                            <a class="btn btn-primary" href="{{ route('products.edit',$value->id) }}">Edit</a>   
                            @csrf
                            @method('DELETE')      
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                    @php
                        $acu = $acu + ($value->quantity)*($value->price)
                    @endphp            
                </tr>
            @endforeach
        </table>
        {!! $data->links() !!}
        <form action="{{route('invoices.index')}}" method="POST">
            @csrf
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Cliente:</strong>
                <select name="client_id" class="form-control">
                    <option value="">Seleccione...</option>
                        @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                </select>                
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Tipo de pago:</strong>
                <select name="payment_id" class="form-control">
                    <option value="">Seleccione...</option>
                        @foreach($payments as $payment)
                            <option value="{{$payment->id}}">{{$payment->payment_type}}</option>
                        @endforeach
                </select>                
            </div>            
            <div class="form-group">
                <strong>Total:</strong>
                <input type="text" name="total" class="form-control" value="{{$acu}}" readonly>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Crear Factura</button> 
            </div>
        </form>
    </div>
</div>  
      
@endsection