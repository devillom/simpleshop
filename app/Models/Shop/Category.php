<?php

namespace App\Models\Shop;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Kalnoy\Nestedset\Node;

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
        return $this->belongsToMany(Field::class, 'shop_category_fields');
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

    /**
     * a method to get the children by order
     * @param type $categories
     * @return type
     */
    public function getChildren()
    {
        return $this->children()->orderBy('_lft')->get();
    }


}
