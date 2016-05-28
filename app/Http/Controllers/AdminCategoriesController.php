<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;
use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Category;

class AdminCategoriesController extends Controller {

    private $categories;

    public function __construct(Category $category) {
        $this->middleware('guest');
        $this->categories = $category;
    }

    public function Index() {
        $categories = $this->categories->all();
        return view('categories', compact('categories'));
    }

    public function postInsert() {
        return "Salva as Informações";
    }

    public function getInsert() {
        return "Exibe o formulário de cadastro";
    }

    public function getDelete($id) {
        return "Deleta o cadastro conforme o id $id";
    }

    public function getEdit($id) {
        return "Altera o cadastro conforme o id $id";
    }

    public function postEdit($id) {
        return "Salva as alterações do id $id";
    }

}
