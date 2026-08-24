<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document</title>
</head>
<body>
    <main class="screen">
        <div class="Box">
            <h2 class="tit">Register</h2>
            <form action="/register" method="POST" class="form">
                @csrf
                <input name="name" type="text" placeholder="Name(Min:3 Max:20)" class="inp">
                <input name="email" type="text" placeholder="Email" class="inp">
                <input name="password" type="password" placeholder="Password(min:8)" class="inp">
                <button>Register</button>
            </form>
        </div>
        <hr>
        <div class="Box">
            <h2 class="tit">Login</h2>
            <form action="/login" method="POST" class="form">
                @csrf
                <input name="loginName" type="text" placeholder="Name" class="inp">
                <input name="loginPassword" type="password" placeholder="Password" class="inp">
                <button>Login</button>
            </form>
        </div>
    </main>

</body>
</html>
