<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Existencia</th>
            <th>Vence</th>
            <th>Pedido</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($stocks as $stock)
            <td>{{ $stock->detail->product->id }}</td>
            <td>{{ $stock->detail->product->name }}</td>
            <td>{{ $stock->detail->sale_price}}</td>
            <td>{{ ($stock->detail->due_date ? $stock->detail->due_date->format('d/m/Y'):'N/A')}}</td>
            <td>{{ $stock->stock}} </td>
            <td><a href="{{  $stock->detail->order->url }}">#{{ $stock->detail->order->id }}</a> </td>
        @endforeach
    </tbody>
</table>