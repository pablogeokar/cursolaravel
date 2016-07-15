<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;

use Illuminate\Support\Facades\Auth;

use CodeCommerce\Order;

use CodeCommerce\Status;

class AdminOrdersController extends Controller
{
    
    private $orders;
    private $status;
    
  public function __construct(Order $order, Status $status) {

        $this->middleware('auth.admin');
        $this->orders = $order;
        $this->status = $status;
        
    }
    
    public function index(){
        $orders = $this->orders->paginate(10);
        $status = $this->status->all();
        return view('orders', compact('orders', 'status'));
    }
    
    public function updateStatus($order, $status){
        $data = $this->orders->find($order);
        $data['status_id'] = $status;
        $data->update();
        return redirect()->route('orders');
    }
}
