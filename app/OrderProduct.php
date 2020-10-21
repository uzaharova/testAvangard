<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\OrderProduct
 *
 * @property-read  \App\Product $product
 */
class OrderProduct extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
