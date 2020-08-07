<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Searchable;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'tvsh', 'weight', 'product_type', 'seller_id'];
}
