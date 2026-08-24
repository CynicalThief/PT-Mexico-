<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function deleteItem(Item $item)
    {
        if(auth()->user()->role === 'admin')
        {
            $item->delete();
        }
        return redirect('/admindash');
    }
    public function updateItem(Item $item, Request $request)
    {
        if(auth()->user()->role === 'admin')
        {
            $incomingFields = $request->validate([
                'title'=>'required|string',
                'price'=>'required|integer',
                'quantity'=>'required|integer',
                'description' => 'required|string',
            ]);
            foreach($incomingFields as $key => $value)
            {
                if(is_string($value))
                {
                    $incomingFields[$key] = strip_tags($value);
                }
            }
            $item->update($incomingFields);
        }
        return redirect('/admindash');
    }

    public function showEdit(Item $item)
    {
        if(auth()->user()->role !== 'admin')
        {
            return redirect('/');
        }
        return view('edit-item', ['item'=> $item]);
    }

    public function createItem(Request $request)
    {
        if(auth()->user()->role === 'admin')
        {
            $incomingFields = $request->validate([
                'title'=>'required|string',
                'price'=>'required|integer',
                'quantity'=>'required|integer',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'description' => 'required|string',
            ]);

            foreach($incomingFields as $key => $value)
            {
                if(is_string($value))
                {
                    $incomingFields[$key] = strip_tags($value);
                }
            }
            if($request->hasFile('photo'))
            {
                $photo = $request->file('photo');
                $photoName = $photo->getClientOriginalName();

                $photo->move(public_path('photos'), $photoName);
                $incomingFields['photo_name'] = $photoName;
            }
            unset($incomingFields['photo']);
            Item::create($incomingFields);
        }
        return redirect('admindash');
    }
}

//remove and edit logic too
