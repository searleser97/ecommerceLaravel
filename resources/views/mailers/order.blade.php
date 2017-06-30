<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
</head>

<body>
    <h1>Hello!</h1>
    <p>We sent you the data of your purchase in ProdutsStore</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->pricing }}</td>
                </tr>
            @endforeach

            <tr>
                <td>Total</td>
                <td>{{ $order->total }}</td>
            </tr>
        </tbody>
    </table>
    <p>
        Permalink: {{url('/orders/'.$shopping_cartID)}}
    </p>
</body>

</html>
