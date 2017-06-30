<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingCart;

use App\PayPal;

use App\Order;

class OrdersController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => 'show']);
        $this->middleware('shoppingCart');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        $totalMonth = Order::totalMonth();
        $totalMonthCount = Order::totalMonthCount();
        
        return view('orders.index', [
            'orders' => $orders,
            'totalMonth' => $totalMonth,
            'totalMonthCount' => $totalMonthCount]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shopping_cart = $request->shopping_cart;

        $paypal = new PayPal($shopping_cart);
        $response = $paypal->execute($request->paymentId, $request->PayerID);
        if($response->state == 'approved') {
            \Session::remove('shopping_cart_id');
            $order = Order::createFromPayPalREsponse($response, $shopping_cart);
            $shopping_cart->approve();
            //$order->sendMail();
        }

        return view('orders.show', ['shopping_cart' => $shopping_cart, 'order' => $order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shopping_cart = $this->getShoppingCartByID($id);
        $order = $shopping_cart->order();
        return view('orders.show', ['shopping_cart' => $shopping_cart, 'order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $field = $request->name;
        $order->$field = $request->value;

        $order->save();

        //$order->sendUpdateMail();

        return $order->$field;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public static function getShoppingCartByID($id) {
        return ShoppingCart::where('customid', $id)->first();
    }
}
