<?php

namespace App;
use PaypalPayment;

class PayPal
{
    private $_apiContext;
    private $shopping_cart;

    public function __construct($shopping_cart) {
        $config = config('paypal_payment');
        $flatConfig = array_dot($config);

        $this->_apiContext = PaypalPayment::ApiContext(
            array_get($flatConfig, 'Account.ClientId'),
            array_get($flatConfig, 'Account.ClientSecret'));
        // $this->_apiContext = \PaypalPayment::ApiContext(config('paypal_payment.Account.ClientId'), config('paypal_payment.Account.ClientSecret'));

        $this->_apiContext->setConfig($flatConfig);
        $this->shopping_cart = $shopping_cart;
    }

    public function generate() {
        $payment = PaypalPayment::payment()->setIntent('sale')
        ->setPayer($this->payer())
        ->setTransactions([$this->transaction()])
        ->setRedirectUrls($this->redirectURLs());
        try {
            $payment->create($this->_apiContext);
        } catch(\Exception $ex) {
            dd($ex);
            exit(1);
        }

        return $payment;
    }

    public function payer() {
        return PaypalPayment::payer()->setPaymentMethod('paypal');
    }

    public function amount() {
        return PaypalPayment::amount()->setCurrency('USD')
        ->setTotal($this->shopping_cart->total());
    }

    public function transaction() {
        return PaypalPayment::transaction()
        ->setAmount($this->amount())
        ->setItemList($this->items())
        ->setDescription('Your purchase at productsStore')
        ->setInvoiceNumber(uniqid());
    }

    public function items() {
        $items = [];
        $products = $this->shopping_cart->products()->get();

        foreach($products as $product) {
            array_push($items, $product->paypalItem());
        }

        return PaypalPayment::itemList()->setItems($items);
    }

    public function redirectURLs() {
        $baseURL = url('/');
        return PaypalPayment::redirectUrls()
        ->setReturnUrl($baseURL.'/orders/new')
        ->setCancelUrl($baseURL.'/carrito');
    }

    public function execute($paymentId, $payerId) {
        $payment = PaypalPayment::getById($paymentId, $this->_apiContext);
        $execution = PaypalPayment::PaymentExecution()
        ->setPayerId($payerId);

        return $payment->execute($execution, $this->_apiContext);
    }
    
}
