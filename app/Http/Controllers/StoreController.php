<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Category;
use CodeCommerce\Product;

class StoreController extends Controller {

    private $categories;
    private $products;

    public function __construct(Category $category, Product $product) {
        $this->categories = $category;
        $this->products = $product;
    }

    public function index() {

        //$pFeatured = $this->products->where('featured', '=', '1' )->get();        
        $pFeatured = $this->products->featured()->get();
        $pRecommend = $this->products->recommend()->get();

        $categories = $this->categories->all();

        return view('store.index', compact('categories', 'pFeatured', 'pRecommend'));
    }

    public function prodsByCategory($id) {
        $category = $this->categories->find($id);
        $products = $category->products;

        $categories = $this->categories->all();

        return view('store.categories', compact('categories', 'products'));
    }

}
