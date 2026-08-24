<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <title>Checkout</title>
</head>
<body>
<div class="checkoutPage">
    <div class="checkoutPanel">
        <a href="/mainpage">
            <button class="butt" type="button">
                Home page
            </button>
        </a>
        <h1 class="titPrim">Checkout</h1>
        <form action="/checkout" method="POST" class="checkoutForm">
            @csrf
            <div class="formRow">
                <label>Shipping Address</label>
                <input type="text" name="shipping_address" placeholder="Shipping address (Min: 10)">
            </div>
            <div class="formRow">
                <label>Postal Code</label>
                <input type="text" name="postal_code" placeholder="Postal Code (5 digits)">
            </div>
            <button class="butt" type="submit">
                Place Order
            </button>
        </form>
    </div>
</div>
</body>
</html>
