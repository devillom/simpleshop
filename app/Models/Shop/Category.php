<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Baum;

class Category extends Baum\Node
{
    protected $table = 'shop_categories';

    // 'parent_id' column name
    protected $parentColumn = 'parent_id';


}
