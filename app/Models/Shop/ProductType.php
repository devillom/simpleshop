<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = 'shop_product_types';
    public $timestamps = false;

    public function products()
    {
        $this->belongsToMany(Product::class);
    }
}
