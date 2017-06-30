{!! Form::open(['url' => '/products/'.$product->id, 'method' => 'DELETE', 'class' => 'inline-block']) !!}

<input type="submit" class="btn-link red-text no-padding no-margin no-transform" value="Delete">

{!! Form::close() !!}