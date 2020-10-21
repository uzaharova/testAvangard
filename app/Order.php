<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Order
 *
 * @property-read \App\Partner $partner
 * @property-read \App\OrderProduct[] $items
 */
class Order extends Model
{
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }
}
