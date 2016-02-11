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
        'type',
        'category_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,'shop_product_fields');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function values()
    {
        return $this->hasMany(FieldValue::class);
    }


    public function options()
    {
        return $this->hasMany(FieldOption::class);
    }

    public function getValue($product_id)
    {
        $value =  $this->values()->where('product_id',$product_id)->first();
        return $value;
    }

}
