{!! Form::open(['url' => '/in_shopping_carts', 'method' => 'POST', 'class' => 'add-to-cart']) !!}

<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="submit" id="addToCart" value="Add to cart" class="btn btn-info">

{!! Form::close() !!}