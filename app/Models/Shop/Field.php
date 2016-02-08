<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public $timestamps = false;

    protected $table = 'shop_fields';
    protected $fillable = [
        'name',
        'content',
        'type'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'shop_product_fields');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'shop_category_fields');
    }

    public function values()
    {
        return $this->hasMany(FieldValue::class);
    }

    public function getValue($product_id)
    {
        $value =  $this->values()->where('product_id',$product_id)->first();
        return $value;
    }

}
