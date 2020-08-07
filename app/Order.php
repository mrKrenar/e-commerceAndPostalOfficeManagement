<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'receiver_name',
        'receiver_tel',
        'receiver_tel2',
        'state',
        'city',
        'address',
        'quantity',
        'weight',
        'order_type',
        'is_openable',
        'is_returnable',
        'additional_notes',
        'order_name',
        'description',
        'price',
        'tvsh',
        'status',
        'seller_id',
        'total_price'
    ];
}
