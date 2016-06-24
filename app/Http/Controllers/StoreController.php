<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Category;
use CodeCommerce\Product;
use CodeCommerce\Tag;

class StoreController extends Controller {

    private $categories;
    private $products;
    private $tags;

    public function __construct(Category $category, Product $product, Tag $tag) {
        $this->categories = $category;
        $this->products = $product;
        $this->tags = $tag;
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
    
    public function category($id){
        
        $categories = $this->categories->all();
        $category = Category::find($id);
        $products = Product::ofCategory($id)->get();
        
        return view('store.category', compact('categories', 'products', 'category'));
    }
    
    public function product($id){
        
        $categories = $this->categories->all();
        $product = $this->products->find($id);
        
        return view('store.product', compact('categories', 'product'));
        
    }
    
    public function tag($id){
        
        $categories = $this->categories->all();
        $tag = $this->tags->find($id);
        
        $products = $tag->products;        
        
        
        return view('store.tags', compact('categories', 'products', 'tag'));        
    }    
    

}
