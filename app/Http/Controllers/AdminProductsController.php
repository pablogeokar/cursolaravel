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
    
    public function Create() {
        return view('admin.products-create');
    }
    
     public function store(Requests\ProductRequest $request) {
        $input = $request->all();
        
        $product = $this->products->fill($input);
        
        $product->save();
        return redirect()->route('products');
    }
    
     public function destroy($id) {
        
        $this->products->find($id)->delete();
        
        return redirect()->route('products');
    }
    
    public function edit($id) {
        
        $product = $this->products->find($id);
        
        return view('admin.products-edit', compact('product'));
    }
    
    public function update(Requests\ProductRequest $request, $id) {
        
        $this->products->find($id)->update($request->all());
        return redirect()->route('products');
    }
}
