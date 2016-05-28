<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;

class AdminProductsController extends Controller
{
    private $products;

    public function __construct(Product $product)
    {
        $this->middleware('guest');
        $this->products = $product;
    }

    public function Index()
    {
        $products = $this->products->all();
        return view('products', compact('products'));
    }
    
    public function postInsert(){
        return "Salva as Informações";
    }
    
    public function getInsert(){
        return "Exibe o formulário de cadastro";
    }
    
    public function getDelete($id){
        return "Deleta o cadastro conforme o id $id";
    }
    
    public function getEdit($id){
        return "Altera o cadastro conforme o id $id";
    }
    
    public function postEdit($id){
        return "Salva as alterações do id $id";
    }
}
