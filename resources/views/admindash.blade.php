<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <title>Admin</title>
</head>
<body>
<div class="adminPage">
    <div class="screenTwo">
        @php
            $usertype = auth()->user();
        @endphp
        <div class="profile">
            <div class="profCon">
                <div class="opTitle">
                    <p class="titSub">Welcome to</p>
                    <h2 class="titPrim">PT Mexico</h2>
                </div>
                <div class="opUser">

                </div>
            </div>
            <div class="tab">
                @if($usertype?->role === 'admin')
                    <a href="/mainpage">
                        <button class="butt">Main Page</button>
                    </a>
                @endif
                <div class="fill">
            </div>
        </div>
    </div>

    <div class="adminPanel">

        <h2 class="panelTitle">Release Item</h2>

        <form action="/post_item" method="POST" enctype="multipart/form-data" class="itemForm">
            @csrf
            <div class="formRow">
                <label>Title</label>
                <input type="text" name="title">
            </div>
            <div class="formRow">
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>
            <div class="formRow">
                <label>Price</label>
                <input type="number" name="price">
            </div>
            <div class="formRow">
                <label>Quantity</label>
                <input type="number" name="quantity">
            </div>
            <div class="formRow">
                <label>Photo</label>
                <input type="file" name="photo">
            </div>
            <button class="butt" type="submit">Create</button>
        </form>
    </div>
    <div class="adminPanel">
        <h2 class="panelTitle">Catalogue:</h2>
        <div class="adminItems">
            @foreach($items as $item)
            <div class="adminCard">
                <div class="adminImage">
                    <img src="{{ asset('photos/' . $item->photo_name) }}">
                </div>
                <div class="adminInfo">
                    <h3>{{ $item->title }}</h3>

                    <p class="description">
                        {{ $item->description }}
                    </p>

                    <p>Price: <strong>{{ $item->price }}</strong></p>

                    <p>Quantity: <strong>{{ $item->quantity }}</strong></p>

                    <div class="adminActions">

                        <a href="/edit-item/{{ $item->id }}">
                            <button class="butt">Edit</button>
                        </a>

                        <form action="/delete-item/{{ $item->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="deleteButt">DELETE</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>

</body>
</html>
