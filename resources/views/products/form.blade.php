 {!! Form::open(['url' => $url, 'method' => $method, 'files' => true]) !!}

<div class="form-group">
    {{ Form::text('title', $product->title, ['class' => 'form-control', 'placeholder' => 'Title...'])}}
</div>
<div class="form-group">
    {{ Form::text('pricing', $product->pricing, ['class' => 'form-control', 'placeholder' => 'Price of your product in cents of dolar'])}}
</div>

<div class="">
    {{ Form::file('cover', ['class' => 'inputfile', 'id' => 'cover']) }}
    <label class="btn" for="cover">Choose a file</label>
</div>

<div class="form-group">
    {{ Form::text('description', $product->description, ['class' => 'form-control', 'placeholder' => 'Describe your product...'])}}
</div>
<div class="form-group text-right">
    <a href="{{ url('/products') }}"> Return to products list </a>
    <input type="submit" value="send" class="btn btn-success">
</div>

{!! Form::close() !!}
