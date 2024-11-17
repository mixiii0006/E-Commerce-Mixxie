<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
</head>
<body>
    <h1>Invoice for Order #{{ $order->id }}</h1>
    <p>Customer: {{ $order->user->name }}</p>
    <p>Date: {{ $order->created_at->format('d M, Y') }}</p>

    <h3>Items:</h3>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ $item->unit_amount }} = {{ $item->total_amount }}</li>
        @endforeach
    </ul>

    <p><strong>Total:</strong> {{ $order->grand_total }}</p>
</body>
</html>
