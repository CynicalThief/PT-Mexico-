<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>Your Cart</title>
</head>
<body>
<div class="cartPage">
    <div class="cartHeader">
        <a href="/mainpage">
            <button class="butt" type="button">
                Home page
            </button>
        </a>
        <h1 class="titPrim">Your Cart</h1>
        @if(session('success'))
            <p class="cartSuccess">
                {{ session('success') }}
            </p>
        @endif
    </div>
    @php
        $total = 0;
    @endphp
    <div class="cartItems">
        @forelse($cart as $itemid => $details)
            @php
                $subtotal = $details['price'] * $details['quantity'];
                $total += $subtotal;
            @endphp
            <div class="cartCard">
                <div class="cartInfo">
                    <h2>{{ $details['title'] }}</h2>
                    <p>
                        Rp. {{ number_format($details['price'], 0, ',', '.') }}
                        × {{ $details['quantity'] }}
                    </p>
                    <p class="cartSubtotal">
                        Subtotal:
                        <strong>
                            Rp. {{ number_format($subtotal, 0, ',', '.') }}
                        </strong>
                    </p>
                </div>

                <div class="quantityControls">
                    <form action="/cart/decrease/{{ $itemid }}" method="POST">
                        @csrf
                        <button class="smallButt" type="submit">−</button>
                    </form>
                    <span class="quantity">
                        {{ $details['quantity'] }}
                    </span>
                    <form action="/cart/addon/{{ $itemid }}" method="POST">
                        @csrf
                        <button class="smallButt" type="submit">+</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="emptyCart">
                <h2>Your cart is empty</h2>
                <p>Go find something nice or whatever.</p>
                <a href="/mainpage">
                    <button class="butt">
                        Browse items
                    </button>
                </a>
            </div>
        @endforelse
    </div>
    @if(count($cart) > 0)
        <div class="cartBottom">
            <div class="cartTotal">
                <span>Total</span>
                <strong>
                    Rp. {{ number_format($total, 0, ',', '.') }}
                </strong>
            </div>
            <div class="cartActions">
                <form action="/cart/clear" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="deleteButt" type="submit">
                        Clear cart
                    </button>
                </form>
                <a href="/checkout">
                    <button class="butt" type="button">
                        Checkout
                    </button>
                </a>
            </div>
        </div>
    @endif
</div>
</body>
</html>
