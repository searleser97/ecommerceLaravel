<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class MainController extends Controller
{

    public function home() {

        $products = Product::latest()->simplePaginate(2);
        return view('main.home', ['products' => $products]);
    }
}
