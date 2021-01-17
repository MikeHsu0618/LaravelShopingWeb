@extends('layouts.app')

@section('content')

<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label>
            Product Name: <input type="text" name="name" value="{{ old('product_name') }}">
        </label>
    </div><br>
    <div>
        <label>
            Product Price: <input type="text" name="price" value="{{ old('product_price') }}">
        </label>
    </div><br>
    <div>
        <label>
            Product Brand: <input type="text" name="brand_name" value="{{ old('brand_name') }}">
        </label>
        </div><br>
        <div>
        <label>
            Product Category: <input type="text" name="category_name" value="{{ old('category_name') }}">
        </label>
        </div>
    <div class="image_uploader">
        <label>
            Product Image:
            <input type="file" name="image" value="{{ old('product_image') }}">
        </label><br>
        <div>
            <img style="max-width:400px;" src="https://via.placeholder.com/400x300">
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
@parent()
<script>
    imageUploader('image_uploader');
</script>
@endsection
