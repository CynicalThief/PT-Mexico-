<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/invoice.css') }}">
    <title>Invoice</title>
</head>
<body>
<div class="invoicePage">
    <div class="invoicePanel">
        <div class="invoiceHeader">
            <h1 class="titPrim">Invoice</h1>
            <p>
                <strong>Invoice Number:</strong>
                {{ $invoice->invoice_number }}
            </p>
        </div>
        <div class="shippingInfo">
            <p>
                <strong>Shipping Address:</strong><br>
                {{ $invoice->shipping_address }}
            </p>
            <p>
                <strong>Postal Code:</strong>
                {{ $invoice->postal_code }}
            </p>
        </div>
        <div class="invoiceTableWrapper">
            <table class="invoiceTable">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                        <tr>
                            <td>{{ $item->category_name }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                Rp. {{ number_format($item->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="invoiceTotal">
            <span>Total</span>
            <strong>
                Rp. {{ number_format($invoice->total, 0, ',', '.') }}
            </strong>
        </div>
        <div class="invoiceActions">
            <button class="butt" type="button" onclick="window.print()">
                Print Invoice
            </button>
            <a href="/mainpage">
                <button class="butt" type="button">
                    Home page
                </button>
            </a>
        </div>
    </div>
</div>
</body>
</html>
