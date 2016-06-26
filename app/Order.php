<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public function items() {
        return $this->hasMany('CodeCommerce\OrderItem');
    }

    public function user() {
        return $this->belongsTo('CodeCommerce\User');
    }

    public function products() {
        $q = $this->items();
        $q->join('products', 'products.id', '=', 'order_items.product_id')
                ->get();
        return $q;
    }

}
