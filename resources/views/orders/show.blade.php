@extends('layouts.app') @section('content')
<header class="big-padding text-center blue-grey white-text">
    <h1>Purchased Completed</h1>
</header>
<div class="container">
    <div class="card large-padding line-height20">
        <h3>
            Your purchased was processed <span class="{{ $order->status }}">{{ $order->status }}</span>
        </h3>
        <p>Check your shipping details</p>
        <div class="row large-padding">
            <div class="col-xs-6">Email</div>
            <div class="col-xs-6">{{ $order->email }}</div>
        </div>
        <div class="row large-padding">
            <div class="col-xs-6">Address</div>
            <div class="col-xs-6">{{ $order->address() }}</div>
        </div>
        <div class="row large-padding">
            <div class="col-xs-6">Postal Code</div>
            <div class="col-xs-6">{{ $order->postal_code }}</div>
        </div>
        <div class="row large-padding">
            <div class="col-xs-6">City</div>
            <div class="col-xs-6">{{ $order->city }}</div>
        </div>
        <div class="row large-padding">
            <div class="col-xs-6">State and Country</div>
            <div class="col-xs-6">{{ "$order->state $order->country_code" }}</div>
        </div>
        <div class="text-center top-space">
            <a href="{{url('/orders/'.$shopping_cart->customid)}}">Permanent link of your purchase</a>
        </div>
    </div>
</div>
@endsection
