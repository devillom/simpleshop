<?php

namespace App\Models\Shop;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Support\Facades\Session;
use Kalnoy\Nestedset\Node;
use App\Photo;
class Category extends Node implements SluggableInterface
{
    use SluggableTrait;
    protected $table = 'shop_categories';

    protected $parentColumn = 'parent_id';

    protected $sluggable = [
        'build_from' => 'name',
        'save_to' => 'slug',
    ];


    protected $fillable = [
        'name', 'slug', 'content', 'parent_id', '_lft', '_rgt'
    ];

    public function products()
    {
        return $this->belongsTomany(Product::class, 'shop_product_categories');
    }

    public function fields()
    {
        return $this->hasmany(Field::class);
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }


    public static function boot()
    {
        parent::boot();
        Category::deleting(function ($category) {

            if (count($category->children) || count($category->products)) {
                Session::flash('error','Сначало удалите подкатегории и товары!');
                return false;
            }
        });
    }


    /**
     * Resets all the nodes as roots
     * @param type $categories
     * @return type
     */
    public static function updateTreeRoots($categories)
    {
        if (is_array($categories)) {
            foreach ($categories as $cat) {
                $node = Category::find($cat['id']);
                $node->parent_id = null;
                $node->save();
            }
        }
    }

    /**
     * Rebuilds the tree: update descendants and their order
     * @param type $categories
     * @return type
     */
    public static function rebuildTree($categories)
    {
        if (is_array($categories)) {
            foreach ($categories as $cat) {
                $node = Category::find($cat['id']);
                //$node->descendants->linknodes();

                //loop recursively through the children
                if (isset($cat['children']) && is_array($cat['children']) && count($cat['children'])) {
                    foreach ($cat['children'] as $child) {
                        //append the children to their (old/new)parents
                        $descendant = Category::find($child['id']);
                        $node->appendNode($descendant);
                        //shift the descendants to the bottom to get the right order at the end
                        $shift = count($descendant->getSiblings());
                        $descendant->down($shift);
                        Category::rebuildTree($cat['children']);
                    }
                }
            }
        }
    }


}
