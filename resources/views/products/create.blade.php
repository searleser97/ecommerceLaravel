@extends('layouts.app');
@section('content');
<div class="container white">
    <h1>New Product</h1>
    @include('products.form', ['product' => $product, 'url' => '/products', 'method' => 'POST'])
</div>
@endsection
