@extends('layouts.app') {{-- remove this line if you don't use a layout, and add <html>/<head>/<body> instead --}}

@section('content')
<div class="cart-page">
    <h1>Your Cart</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table border="1" cellpadding="8" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $itemId => $details)
                    @php $subtotal = $details['price'] * $details['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $details['title'] }}</td>
                        <td>{{ $details['price'] }}</td>
                        <td>{{ $details['quantity'] }}</td>
                        <td>{{ $subtotal }}</td>
                        <td>
                            <form action="{{ url('/cart/addon/' . $itemId) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">+</button>
                            </form>
                            <form action="{{ url('/cart/decrease/' . $itemId) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit">-</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: {{ $total }}</h3>

        <form action="{{ url('/cart/clear') }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Clear Cart</button>
        </form>

        <a href="{{ url('/checkout') }}">
            <button type="button">Proceed to Checkout</button>
        </a>
    @endif

    <a href="{{ url('/mainpage') }}">← Continue Shopping</a>
</div>
@endsection
