<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="screenTwo">
        @php
            $usertype = auth()->user();
        @endphp
        <div class="profile">
            <div class="profCon">
                <div class="opTitle">
                    <p class="titSub">Welcome to</p>
                    <h2 class="titPrim">PT Mexico <i class="usrname">{{ auth()->user()->name}}</i></h2>
                </div>
            </div>
            <div class="tab">
                @if($usertype?->role === 'admin')
                    <a href="/admindash">
                        <button class="butt">Admin dashboard</button>
                    </a>
                @endif
                <a href="/cart">
                    <button class="butt">View cart</button>
                </a>
                <div class="fill">
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="exit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="lowScreen">
            <div class="screenSub">
                @foreach($items as $item)
                <div class="card">
                    <div class="cardImage">
                        <img src="{{ asset('photos/' . $item->photo_name) }}">
                    </div>
                    <div class="cardInfo">
                        <h3>{{ $item->title }}</h3>
                        <p class="description">{{ $item->description }}</p>
                        <p>
                        Price: <strong>Rp. {{ number_format($item->price, 0, ',', '.') }}</strong>
                        </p>
                        <p>Quantity: <strong>{{ $item->quantity }}</strong></p>
                        <div class="cardActions">
                        <form action="/cart/add/{{ $item->id }}" method="POST">
                            @csrf
                            @if($item->quantity > 0)
                                <button class="butt" type="submit">
                                Add to cart
                                </button>
                            @else
                                <p class="outStock">Out of stock!</p>
                            @endif
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
