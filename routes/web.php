<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControl;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Models\Item;

Route::get('/', function () {
    $items = Item::all();
    return view('homepage', ['items' => $items]);
});

Route::get('/mainpage', function () {
    $items = Item::all();
    return view('mainpage', ['items' => $items]);
});

Route::get('/admindash', function(){
    $items = Item::all();
    return view('admindash', ['items' => $items]);
})->middleware('admin');

Route::get('/edit-item', function(){
    return view('/edit-item');
})->middleware('admin');

Route::get('index', function(){
    return view('/index');
});



Route::post('/register', [UserControl::class, 'register']);
Route::post('/logout', [UserControl::class, 'logout']);
Route::post('/login', [UserControl::class, 'login']);
Route::post('/post_item', [ItemController::class, 'createItem']);
Route::get('/edit-item/{item}', [ItemController::class, 'showEdit']);
Route::put('/edit-item/{item}', [ItemController::class, 'updateItem']);
Route::delete('/delete-item/{item}', [ItemController::class, 'deleteItem']);
Route::post('/cart/add/{item}', [CartController::class, 'addCart']);
Route::get('/cart', [CartController::class, 'inCart']);
Route::delete('/cart/clear', [CartController::class, 'removeCart']);
Route::post('/cart/decrease/{itemid}', [CartController::class, 'decCart']);
Route::post('/cart/addon/{item}', [CartController::class, 'incCart']);
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store']);
Route::get('/invoice', [CheckoutController::class, 'showInvoice']);
