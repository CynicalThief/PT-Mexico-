<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <title>Edit Item</title>
</head>
<body>
<div class="editPage">
    <div class="editPanel">
        <form action="/edit-item/{{ $item->id }}" method="POST" class="editForm">
            @csrf
            @method('PUT')
            <div class="editImage">
                <img src="{{ asset('photos/' . $item->photo_name) }}">
            </div>
            <div class="formRow">
                <label>Title</label>
                <input type="text" name="title" value="{{ $item->title }}">
            </div>
            <div class="formRow">
                <label>Description</label>
                <textarea name="description">{{ $item->description }}</textarea>
            </div>
            <div class="formRow">
                <label>Price</label>
                <input type="number" name="price" value="{{ $item->price }}">
            </div>
            <div class="formRow">
                <label>Quantity</label>
                <input type="number" name="quantity" value="{{ $item->quantity }}"">
            </div>
            <div class="editActions">
                <button class="butt" type="submit">
                    Save changes
                </button>
                <a href="/admindash">
                    <button class="cancelButt" type="button">
                        Cancel
                    </button>
                </a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
