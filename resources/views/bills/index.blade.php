@extends('layouts.base')
@section('breadcrumb')
    <li class="breadcrumb-item">Ventas</li>
@stop
@section('content')
<div class="row">
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <a  href="{{ route('bills.create') }}">
            <div class="smallstat">
                <i class="fa fa-shopping-cart primary"></i>
                <span class="value text-primary">Facturar</span>
            </div><!--/.smallstat-->
        </a>
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat">
            <i class="fa fa-calendar-o success"></i>
            <span class="value text-success">Q. {{ $sales_day->sum('total') }}</span>
            <span class="title">Ventas {{ Carbon\Carbon::now()->format('d-m-Y') }}</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat">
            <canvas id="myChart" height="100"></canvas>
        </div><!--/.smallstat-->
    </div><!--/.col-->
    <div class="col-lg-3 col-sm-6 col-xs-6 col-xxs-12">
        <div class="smallstat">
            <i class="fa fa-calendar warning"></i>
            <span class="value text-warning">Q. {{ $sales_month->sum('total') }}</span>
            <span class="title">Ventas del Mes</span>
        </div><!--/.smallstat-->
    </div><!--/.col-->
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i-fa class="fa-grid"></i-fa>
                <strong>Ventas</strong>
                <small>Listado</small>
            </div>
            <div class="panel-body">
                <div class="table-resposive">
                    <table class="table col-sm-12">
                        <tr>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Productos</th>
                            <th>Total</th>
                            <th>Vendedor</th>
                            <td></td>
                        </tr>
                        @foreach ($bills as $bill)
                        <tr>
                            <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                            <td>{{ $bill->people->name }}</td>
                            <td>{{ $bill->details->sum('lot') }}</td>
                            <td >Q. {{ $bill->total }}</td>
                            <td>{{ $bill->user->name }}</td>
                            <td><a href="{{ $bill->urlBill }}" class="btn btn-info "> <i class="fa fa-eye-o"></i>  Ver Detalle</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                {{ $bills->links() }}
            </div>
        </div>
    </div>
</div>

<table class="hidden">
    @foreach ($diary_sales as $diary)
    <tr>
        <td class="label">{{ $diary->date }}</td>
        <td class="data">{{ $diary->total }}</td>
    </tr>
    @endforeach
</table>

@stop
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
    <script>
        var ctx = document.getElementById("myChart");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: generateLabelsFromTable(),
                datasets: [
                {
                    label: "Total Venta",
                    fill: true,
                    lineTension: 0.1,
                    backgroundColor: "rgba(75,192,192,0.4)",
                    borderColor: "rgba(75,192,192,1)",
                    borderCapStyle: 'butt',
                    borderDash: [],
                    borderDashOffset: 0.0,
                    borderJoinStyle: 'miter',
                    pointBorderColor: "rgba(75,192,192,1)",
                    pointBackgroundColor: "#fff",
                    pointBorderWidth: 1,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(75,192,192,1)",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointHoverBorderWidth: 2,
                    pointRadius: 1,
                    pointHitRadius: 10,
                    data: generateDataFromTable(),
                    spanGaps: false,
                }
            ]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Ventas diarias',
                    position: 'top',
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }],
                }
            }
        });
        function generateLabelsFromTable()
        {
            var elementos = $('.label');
            var size = elementos.size();
            var data = [];

            $.each( elementos, function(i, val){
                data.push( $(val).html() );
            });
            return data;
        }
        function generateDataFromTable()
        {
            var elementos = $('.data');
            var size = elementos.size();
            var data = [];

            $.each( elementos, function(i, val){
                data.push( $(val).html() );
            });
            return data;
        }
    </script>
@stop

