<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Models\Shop\Category;
use App\Photo;
class Product extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $table = 'shop_products';
    protected $fillable = [
        'name',
        'content',
        'price',
        'active'

    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class,'shop_product_categories');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

}
