@extends('layouts.app')

@section('content')

<h1>Products </h1>
<div>
    <a href="{{ route('products.create') }}">Create</a>
    <hr/>
</div>
@foreach ($products as $product)
<div>
    <div>
        <a href="{{ route('products.show', ['product' => $product->id ]) }}">
            <img width="400" src="{{ asset('storage/'.$product->image_url) }}">
        </a>
    </div>
    <p>{{$product->name}}</p>
    <p>{{$product->brand_name}}</p>
    <p>{{$product->category_name}}</p>
    <div>
        <a href="{{ route('products.edit', ['product' => $product->id ]) }}">Edit</a>
        <form method="post" action="{{ route('products.destroy', ['product' => $product->id ]) }}">
            @csrf
            @method('delete')
            <button type="submit">delete</button>
        </form>
    
    </div>
    <hr/>
</div>
@endforeach



@endsection

@section('inline_js')
    @parent
@endsection