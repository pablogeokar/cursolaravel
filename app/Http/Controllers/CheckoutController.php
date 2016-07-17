<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
//use CodeCommerce\Http\Requests;
use Illuminate\Support\Facades\Session;
use CodeCommerce\Order;
use CodeCommerce\OrderItem;
use Illuminate\Support\Facades\Auth;
use CodeCommerce\Product;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Purchases\Transactions\Locator;
//use PHPSC\PagSeguro\Requests\PreApprovals\Request;

class CheckoutController extends Controller {

    private $order;

    public function __construct(Order $order) {
        $this->order = $order;
    }

    public function place(Order $orderModel, OrderItem $orderItem, CheckoutService $checkoutService) {

        if (Session::has('cart')) {

            $cart = Session::get('cart');

            if ($cart->getTotal() > 0) {

                //Integração PagSeguro
                $checkout = $checkoutService->createCheckoutBuilder();
                //fim Integração PagSeguro


                /*
                  $order = $orderModel->create([
                  'user_id' => Auth::user()->id,
                  'total' => $cart->getTotal()
                  ]);
                 * 
                 */

                //Método recortado para a função finalizaCompra()
                /*
                  $order = $this->order->create([
                  'user_id' => Auth::user()->id,
                  'total' => $cart->getTotal()
                  ]);


                  foreach ($cart->all() as $k => $item) {
                  //Add Item PagSeguro
                  $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, '.', ','), $item['qtd']));
                  //fim Add Item PagSeguro

                  $order->items()->create([
                  'product_id' => $k,
                  'price' => $item['price'],
                  'qtd' => $item['qtd'],
                  'total' => $item['price'] * $item['qtd'],
                  ]);
                  }

                  $cart = Session::forget('cart');

                 */


                //event(new \CodeCommerce\Events\CheckoutEvent(Auth::user(), $order));
                //Checkout PagSeguro
                foreach ($cart->all() as $k => $item) {
                    $checkout->addItem(new Item($k, $item['name'], number_format($item['price'], 2, ".", ""), $item['qtd']));
                }
                $response = $checkoutService->checkout($checkout->getCheckout());

                //Atualiza o código da transação no cart
                //$this->saveTransaction($order->id, $response->getCode());



                return redirect($response->getRedirectionUrl());
                //fim Checkout PagSeguro
                //Antigo retorno                
                //return redirect()->route('order', ['id' => $order->id]); //mostra o pedido
            }
        }

        return redirect()->route('products.cart');
    }

    public function order(Order $find_order, $id) {
        $order = $find_order->find($id);

        return view('store.order', compact('order'));
    }

    //Salva o código da transação do pagseguro
    private function saveTransaction($idOrder, $transaction_pagseguro) {
        $order = $this->order->find($idOrder)
                ->update(['transaction_id' => $transaction_pagseguro]);
    }

    public function finalizaCompra(\Illuminate\Http\Request $request, Locator $service, Order $orderModel) {

        if (!Session::has('cart')) {
            return "Não existe sessão";
        }

        $cart = Session::get('cart');

        //Trecho de código de NiltonMorais 
        //https://github.com/NiltonMorais/laravel_commerce/blob/master/app/Http/Controllers/CheckoutController.php
        $transaction_code = $request->get('transaction_id');
        $transaction = $service->getByCode($transaction_code);        
        $status = $transaction->getDetails()->getStatus();        
        $payment_type = $transaction->getPayment()->getPaymentMethod()->getType();        
        $netAmount = $transaction->getPayment()->getNetAmount();        
        
        //Cria o registro na tabela orders
        $order = $orderModel->create([
            'user_id' => Auth::user()->id,
            'total' => $cart->getTotal(),
            'transaction_id' => $transaction_code,
        ]);
        
        
        //Cria os registros na tabela items (detalhe de orders)
        foreach ($cart->all() as $k => $item) {
            $order->items()->create(['product_id' => $k, 'price' => $item['price'], 'qtd' => $item['qtd'], 'total' => $item['price'] * $item['qtd'],]);
        }
        
        //Limpa a sessão do carrinho de compras 
        $cart = Session::forget('cart');

        //Retorna o usuário a listagem de pedidos
        return redirect()->route('account.orders');
    }

    public function test(CheckoutService $checkoutService) {
        $checkout = $checkoutService->createCheckoutBuilder()
                ->addItem(new Item(1, 'Televisao', 8999.99))
                ->getCheckout();

        $response = $checkoutService->checkout($checkout);
        return redirect($response->getRedirectionUrl());
    }

}
