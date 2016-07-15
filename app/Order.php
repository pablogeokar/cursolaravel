<?php

namespace CodeCommerce;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [
        'user_id',
        'total',
        'status_id'
    ];

    public function items() {
        return $this->hasMany('CodeCommerce\OrderItem');
    }

    public function user() {
        return $this->belongsTo('CodeCommerce\User');
    }

    /*
    public function getDescStatusAttribute() {        
        switch ($this->status){
            case 0:
                return 'Aguardando Pagamento';
                break;
        }
    }
     * 
     */

    public function products() {
        $q = $this->items();
        $q->join('products', 'products.id', '=', 'order_items.product_id')
                ->get();
        return $q;
    }
    
    public function status(){
        return $this->belongsTo('CodeCommerce\Status');
    }

}
