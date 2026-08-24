<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'title',
        'price',
        'quantity',
        'photo_name',
        'description',
    ];
}
