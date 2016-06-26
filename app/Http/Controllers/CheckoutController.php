<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use Illuminate\Support\Facades\Session;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Support\Facades\Auth;
use CodeCommerce\Product;

class CheckoutController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function place(Order $orderModel, OrderItem $orderItem) {

        if (Session::has('cart')) {

            $cart = Session::get('cart');

            if ($cart->getTotal() > 0) {

                $order = $orderModel->create([
                    'user_id' => Auth::user()->id,
                    'total' => $cart->getTotal()
                ]);


                foreach ($cart->all() as $k => $item) {
                    $order->items()->create([
                        'product_id' => $k,
                        'price' => $item['price'],
                        'qtd' => $item['qtd'],
                        'total' => $item['price'] * $item['qtd']
                    ]);
                }

                $cart = Session::forget('cart');
                return redirect()->route('order', ['id' => $order->id]);
            }
        }

        return redirect()->route('products.cart');
    }

    public function order(Order $find_order, $id) {
        $order = $find_order->find($id);

        return view('store.order', compact('order'));
    }

}
