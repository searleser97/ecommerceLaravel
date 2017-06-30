<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingCart;
use App\PayPal;
use App\Order;

class ShoppingCartsController extends Controller
{
    public function __construct() {
        $this->middleware('shoppingCart');
    }

    public function index(Request $request) {

        $shopping_cart = $request->shopping_cart;

        $products = $shopping_cart->products()->get();
        $total = $shopping_cart->total();

        return view('shoppingCarts.index', ['products'=> $products, 'total' => $total]);
    }

    public function checkout(Request $request) {
        $shopping_cart = $request->shopping_cart;
        $paypal = new PayPal($shopping_cart);
        $payment = $paypal->generate();
        return  redirect($payment->getApprovalLink());
    }
}
