@extends('layouts.app')

@section('content')

<form method="post"
    action="{{ route('products.update', ['product' => $product->id]) }}"
    enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <h3>{{ $product->name }}</h3>
    <div>
        <label>
            Product Name: <input type="text" name="name"
                value="{{ old('name',$product->name) }}">
        </label>
    </div>
    <div>
        <label>
            Product Price: <input type="number" name="price"
                value="{{ old('price',$product->price) }}">
        </label>
    </div>
    <div>
    <label>
        Product Brand: <input type="text" name="brand_name" value="{{ old('brand_name',$product->brand_name) }}">
    </label>
    </div><br>
    <div>
    <label>
        Product Category: <input type="text" name="category_name" value="{{ old('category_name',$product->category_name) }}">
    </label>
    </div>
    <div class="image_uploader">
        <label>
            Product Image:
            <input type="file" name="product_image" value="{{ old('product_image') }}">
        </label><br>
        <div>
            <img style="max-width:400px;" src="{{ asset('storage/'.$product->image_url) }}">
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-info  m-3">Submit</button>
    </div>
</form>

@if($errors->products->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->products->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
@section('inline_js')
<script>
    imageUploader('image_uploader');

</script>
@endsection
