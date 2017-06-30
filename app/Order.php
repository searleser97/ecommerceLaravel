<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderCreated;
use App\Mail\OrderUpdated;

class Order extends Model
{
    protected $fillable = ['shopping_cart_id', 'line1', 'line2', 'city', 'postal_code', 'country_code', 'state', 'recipient_name', 'email', 'status', 'guide_number', 'total'];

    public function sendMail() {
        Mail::to('serchgabriel97@gmail.com')->send(new OrderCreated($this));
    }

    public function sendUpdateMail() {
        Mail::to('serchgabriel97@gmail.com')->send(new OrderUpdated($this));
    }

    public function scopeLatest($query) {
        return $query->monthly()->orderID();
    }

    public function scopeOrderID($query) {
        return $query->orderBy('id', 'desc');
    }

    public function scopeMonthly($query) {
        return $query->whereMonth('created_at', '=', date('m'));
    }

    public function address() {
        return "$this->line1 $this->line2";
    }

    public function ShoppingCart() {
        return $this->belongsTo('App\ShoppingCart');
    }

    public static function createFromPayPalREsponse($response, $shopping_cart) {
        $payer = $response->payer;
        $orderData = (array) $payer->payer_info->shipping_address;
        $orderData = $orderData[key($orderData)];
        $orderData['email'] = $payer->payer_info->email;
        $orderData['total'] = $shopping_cart->total();
        $orderData['shopping_cart_id'] = $shopping_cart->id;
        return Order::create($orderData);
    }

    public static function totalMonth() {
        return Order::monthly()->sum('total');
    }

    public static function totalMonthCount() {
        return Order::monthly()->count();
    }

}
