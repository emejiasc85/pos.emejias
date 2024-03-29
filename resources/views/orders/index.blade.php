@extends('layouts.base')

@section('breadcrumb')
<li class="breadcrumb-item">Pedidos</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-truck"></i>
                <strong>Pedidos</strong>
                <small>Listado</small>
                <a href="{{ route('orders.create') }}" class="btn btn-primary pull-right btn-sm" style="margin-top: 5px"><span class="fa fa-plus"></span> Agregar Pedido</a>
            </div>
            <div class="panel-body">
                @include('orders.partials.search')
                <div class="row">
                    <div class="table-responsive col-xs-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proveedor</th>
                                    <th>Priodidad</th>
                                    <th>Fecha</th>
                                    <th>Fec. ingreso</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->people->name }}</td>
                                    <td><span {!! Html::classes(['label', 'label-danger' => $order->priority == 'Alta', 'label-warning' => $order->priority == 'Media', 'label-success' => $order->priority == 'Baja']) !!}>{{ $order->priority }}</span></td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if ($order->status == 'Ingresado')
                                        {{ $order->updated_at->format('d-m-y') }}
                                        @else
                                        N/A
                                        @endif
                                    </td>
                                    <td><span {!! Html::classes(['label', 'label-info' => $order->status == 'Creado', 'label-primary' => $order->status == 'Solicitado', 'label-success' => $order->status == 'Ingresado', 'label-default' => $order->status == 'Cancelado']) !!}>{{ $order->status }}</span></td>
                                    <td>Q. {{ $order->total }}</td>
                                    <td><a href="{{ $order->url }}" class="btn btn-info btn-sm"> <i class="fa fa-eye"></i> Detalle</a></td>
                                    <td>
                                        @if ($order->status != 'Ingresado' || auth()->user()->isAdmin())
                                            <a href="#" data-id="{{ $order->id }}"  class="btn btn-danger btn-sm destroyOrder" >Eliminar</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="panel-footer">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@stop
@section('modals')
    @include('orders.partials.modal_order_destroy')
@stop
@section('scripts')
<script>
    $(document).ready(function() {
        $('.destroyOrder').click( function (e) {
            e.preventDefault();
            var link  = $(this);
            var value = link.data('id');
            var input = $('#order_id');
            input.val(value);
            $('#confirmDeleteOrder').modal('toggle');
        });
    });
</script>
@stop
