<?php

namespace App\Models\Shop;


use Baum;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Models\Shop\Field;

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

    public function fields()
    {
        return $this->belongsToMany(Field::class, 'shop_category_fields');
    }


}
