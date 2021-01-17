<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    function index(){
        $cartItems = $this->getCartItems();
        return view('cart.index', [
            "cartItems" => $cartItems
        ]);
    }

    private function getCartFromCookie(){
        $cart = Cookie::get('cart');
        $cart =  (!is_null($cart))? $cart = json_decode($cart, true): [];
        return $cart;
        }

    private function getCartItems(){
        $cart = $this->getCartFromCookie();
        $productIds = array_keys($cart);
        $cartItems = array_map(function($productId) use ($cart){
            $quantity = $cart[$productId];
            $product = $this->getProduct($productId);
            if ($product){
                return [
                    "product" => $product,
                    "quantity" => $quantity
                ];
            }else{
                return null;
            }

        },$productIds);
        return $cartItems;
        // $products = $this->getProducts();
    }
    

    private function getProduct($id){
        $products = $this->getProducts();
        foreach($products as $product){
            if($product["id"] == $id) return $product;
        }
        return null;
    }

    public function updateCookie(Request $request){
        $cart = $this->getCartFromCookie();
        foreach($cart as $productId => $currentQuantity){
            $key = "product_".$productId;
            if(request()->has($key)) $cart[$productId] = request()->input($key);
        }
        
        $cartToJson = empty($cart) ? "{}" : json_encode($cart, true);//$cart由陣列轉成JSON物件
        Cookie::queue(
            Cookie::make('cart', $cartToJson , 60*24*7, null, null, false, false)
        );

        return redirect()->route('cart.index');
    }

    public function deleteCookie(Request $request){
        if($request->has('id')){
            $cart = $this->getCartFromCookie();
            $productId = $request->input('id');
            if( isset($cart[$productId])){
                unset($cart[$productId]);               
                $cartToJson = empty($cart) ? "{}" : json_encode($cart, true);//$cart由陣列轉成JSON物件
                Cookie::queue(
                    Cookie::make('cart', $cartToJson, 60 * 24 * 7, null, null, false, false)
                );
                $cart = $this->getCartFromCookie();
                return response('success');
            }
        }
        return response('failed');
    }



    private function getProducts()
    {
        return [
            [
                "id" => 1,
                "name" => "Orange",
                "price" => 30,
                "imageUrl" => asset('images/orange01.jpg')
            ],
            [
                "id" => 2,
                "name" => "Apple",
                "price" => 20,
                "imageUrl" => asset('images/apple01.jpg')
            ]
        ];
    }
}
