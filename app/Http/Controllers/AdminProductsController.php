<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;
use CodeCommerce\Category;


class AdminProductsController extends Controller {

    private $products;

    public function __construct(Product $product) {
        $this->middleware('guest');
        $this->products = $product;
    }

    public function Index() {
        $products = $this->products->paginate(10);
        return view('products', compact('products'));
    }

    public function Create(Category $category) {
        $categories = $category->lists('name', 'id');
        return view('admin.products-create', compact('categories'));
    }

    public function store(Requests\ProductRequest $request) {
        $input = $request->all();

        $product = $this->products->fill($input);
        $product['featured'] = $product['featured'] ? 1 : 0;
        $product['recommend'] = $product['recommend'] ? 1 : 0;


        $product->save();
        return redirect()->route('products');
    }

    public function destroy($id) {

        $this->products->find($id)->delete();

        return redirect()->route('products');
    }

    public function edit(Category $category, $id) {

        $product = $this->products->find($id);
        $categories = $category->lists('name', 'id');

        return view('admin.products-edit', compact('product', 'categories'));
    }

    public function update(Requests\ProductRequest $request, $id) {

        $request['featured'] = $request['featured'] ? 1 : 0;
        $request['recommend'] = $request['recommend'] ? 1 : 0;

        $this->products->find($id)->update($request->all());
        return redirect()->route('products');
    }
    
    public function images($id){
        $products = $this->products->find($id);
        
        return view('images', compact('products'));
    }

}
