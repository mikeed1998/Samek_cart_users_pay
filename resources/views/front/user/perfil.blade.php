@extends('layouts.front')

@section('cssExtras')
@endsection

@section('styleExtras')
@endsection

@section('content')
<div class="container mt-5 mb-5 py-5">
    @if (Session::has('success'))
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-12 fs-1 text-center">
            Mi perfil
        </div>
        {{-- <div class="col-12 fs-2">Mis datos</div> --}}
        {{-- <div class="col-9 mx-auto py-5">
            <div class="row">
                <div class="col-3 fs-5">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control editarajax"  data-id="{{ $user->id }}" data-table="User" data-campo="name" value="{{ $user->name }}">
                </div>
                <div class="col-3 fs-5">
                    <label for="">Apellidos</label>
                    <input type="text" class="form-control editarajax"  data-id="{{ $user->id }}" data-table="User" data-campo="lastname" value="{{ $user->lastname }}">
                </div>
                <div class="col-3 fs-5">
                    <label for="">Número de Telefono</label>
                    <input type="text" class="form-control editarajax"  data-id="{{ $user->id }}" data-table="User" data-campo="telefono" value="{{ $user->telefono }}">
                </div>
                <div class="col-3 fs-5">
                    <label for="">Nombre de Usuario</label>
                    <input type="text" class="form-control editarajax"  data-id="{{ $user->id }}" data-table="User" data-campo="username" value="{{ $user->username }}">
                </div>
            </div>
        </div> --}}
    </div>
    <hr class="border-bottom border-dark border-4">
    <div class="row">
        <div class="col-md-9 mx-auto col-md-offset-4">
            <h2 class="fs-1 text-center">Historial de compras</h2>

            <div class="row">
                @foreach ($orders as $order)
                    <div class="row mt-5">
                        <div class="col-8 fs-5 fw-bolder border">
                            Producto
                        </div>
                        <div class="col-2 text-center fs-5 fw-bolder border">
                            Unidades
                        </div>
                        <div class="col-2 fs-5 fw-bolder border">
                            Total individual
                        </div>
                    </div>
                    <div class="row">
                    @foreach ($order->cart->items as $item)
                        <div class="col-8 fs-5 fw-normal border">
                            {{ $item['item']['nombre'] }}
                        </div>
                        <div class="col-2 text-center fs-5 fw-normal border">
                            {{ $item['qty'] }}
                        </div>
                        <div class="col-2 fs-5 fw-normal border">
                            ${{ $item['price'] }}
                        </div>
                    @endforeach
                </div>
                    <div class="col-12 text-start fs-4 fw-bolder">
                        Total pagado: ${{ $order->cart->totalPrice }}
                        <p class="fw-normal">Fecha de la Compra: {{ $order->created_at->format('d/m/Y') }}</p>
                    </div>
                @endforeach
            </div>


            {{-- @foreach ($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group mt-5">
                            @foreach ($order->cart->items as $item)
                                <li class="list-group-item">
                                    {{ $item['item']['nombre'] }} | {{ $item['qty'] }} Units
                                    <span class="badge bg-secondary text-white">${{ $item['price'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <strong>Total pagado: ${{ $order->cart->totalPrice }}</strong>
                    </div>
                </div>    
            @endforeach --}}
            
        </div>
    </div>
</div>
@endsection

@section('jsLibExtras2')
@endsection
