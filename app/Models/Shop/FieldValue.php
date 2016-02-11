<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class FieldValue extends Model
{
    protected $table = 'shop_field_values';

    protected $fillable = [
      'value_str',
      'value_int',
      'value_dt',
      'value_text',
      'value_select',
      'field_id',
      'product_id'
    ];
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
