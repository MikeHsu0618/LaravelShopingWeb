@extends('layouts.app') @section('content')

<H1>Cart</H1>
<form action="{{ route('cart.cookie.update') }}" method="POST">
    @csrf
    @method('PATCH')
    <table class="m-3" border="2">
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $cartItem)
                <tr>
                    <td>
                        <p>{{ $cartItem["product"]["name"] }}</p>
                        <img src="{{ $cartItem["product"]["imageUrl"] }}"
                            style="width:80">
                    </td>
                    <td>${{ $cartItem["product"]["price"] }}</td>
                    <td>
                        <input type="number" min="1" name="product_{{
                        $cartItem["product"]["id"]
                    }}" value="{{ $cartItem["quantity"] }}">
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger m-3 cartDeleteBtn" data-id="{{ $cartItem["product"]["id"] }}">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr />
    <button type="submit" 
    class="btn btn-primary m-3">
    Update
</button>
</form>

@endsection

@section('inline_js') 
    @parent 
    <script>
        initCartDeleteButton("{{ route('cart.cookie.delete') }}");
    </script>
@endsection
