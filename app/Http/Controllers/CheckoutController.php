<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Illuminate\Support\Facades\DB;


class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|regex:/^[0-9]{5}$/',
        ]);

        $cart = session()->get('cart', []);

        if(empty($cart))
        {
            return back()->with('error', 'cart is empty');
        }

        DB::transaction(function() use ($request, $cart)
        {
            $total = 0;
            foreach($cart as $details)
            {
                $total += $details['price'] * $details['quantity'];
            }

            $invoice = Invoice::create([
                'user_id' => auth()->id(),
                'invoice_number' => 'INV-' . date('Ymd') . '-' . str_pad(Invoice::count() + 1,4, '0', STR_PAD_LEFT),
                'shipping_address' => $request->shipping_address,
                'postal_code' => $request->postal_code,
                'total' => $total,
            ]);

            foreach($cart as $itemid => $details)
            {
                $item = Item::find($itemid);

                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'item_id' =>$itemid,
                    'category_name' =>$item->category->name ?? 'unknown',
                    'item_name' => $details['title'],
                    'quantity' => $details['quantity'],
                    'subtotal' => $details['price'] * $details['quantity'],
                ]);

                $item->decrement('quantity', $details['quantity']);
            }

            session()->forget('cart');
            session()->put('last_invoice_id', $invoice->id);
        });
        return redirect('/invoice');
    }
    public function showInvoice()
    {
        $invoiceId = session()->get('last_invoice_id');

        if (!$invoiceId)
        {
            return redirect('/')->with('error', 'No invoice found');
        }

        $invoice = Invoice::with('items')->findOrFail($invoiceId);

        return view('invoice', compact('invoice'));
    }
}
