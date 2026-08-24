<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Http\Controllers\ItemController;


class CartController extends Controller
{
    public function addCart(Item $item)
    {
        if($item->quantity <= 0)
        {
            return back()->with('error', 'Item is empty!');
        }
        $cart = session()->get('cart', []);

        if(isset($cart[$item->id]))
        {
            $cart[$item->id]['quantity']++;
        } else
        {
            $cart[$item->id] = [
                'title' => $item->title,
                'price' => $item->price,
                'quantity' =>1,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Item added to cart');
    }

    public function inCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function removeCart()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared');
    }

    public function decCart($itemid)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$itemid]))
        {
            $cart[$itemid]['quantity']--;

            if($cart[$itemid]['quantity'] <= 0)
            {
                unset($cart[$itemid]);
            }
        }

        session()->put('cart', $cart);
        return back()->with('success', 'cart updated');

    }
    public function incCart(Item $item)
    {
        if($item->quantity <= 0)
        {
            return back()->with('error', 'Item out of stock!');
        }
        $cart = session()->get('cart', []);

        $quantityInCrt = isset($cart[$item->id]) ? $cart[$item->id]['quantity'] : 0;

        if($quantityInCrt + 1 > $item->quantity)
        {
            return back()->with('error', 'Amount in cart exceeded stock!');
        }
        if(isset($cart[$item->id]))
        {
            $cart[$item->id]['quantity']++;
        } else
        {
            $cart[$item->id] = [
                'title' => $item->title,
                'price' => $item->price,
                'quantity' =>1,
            ];

        }

        session()->put('cart', $cart);
        return back()->with('success', 'cart updated');

    }

}
