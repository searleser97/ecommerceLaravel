<div class="card product text-left line-height20">
    @if(Auth::check() && $product->user_id == Auth::user()->id)
    <div class="absolute actions">
        <a href="{{ url('/products/'.$product->id.'/edit') }}">
            Edit
        </a> @include('products.delete', ['product' => $product])
    </div>
    @endif
    <h1> {{ $product->title }}</h1>
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            @if($product->extension)
            <img class="product-img" src="{{ url('/products/images/'.$product->id.'.'.$product->extension) }}" alt="">
            @endif
        </div>
        <div class="col-sm-6 col-xs-12">
            <p>
                <strong>Description</strong>
            </p>
            <p>
                {{ $product->description }}
            </p>
            <p>
                @include('inShoppingCarts.form', ['product' => $product])
            </p>
        </div>
    </div>
</div>