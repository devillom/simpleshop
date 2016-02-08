<?php

namespace App\Models\Shop;


use Baum;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;


class Category extends Baum\Node implements SluggableInterface
{
    use SluggableTrait;
    protected $table = 'shop_categories';

    protected $parentColumn = 'parent_id';

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];


    protected $fillable = [
      'name', 'slug', 'content', 'parent_id'
    ];

    public function products()
    {
        return $this->belongsTomany(Product::class,'shop_product_categories');
    }


}
