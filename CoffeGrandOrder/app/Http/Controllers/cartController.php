<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class cartController extends Controller
{
    //
    function addItem($id){
        /*
        $req->name
        $req->quality
        $req->image
        $req->price 
        */
        /// store int session ///

        $product = Product::find($id);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        if(!$cart){
            $cart = [
                $id => [
                "name" =>$product->name,
                "img" => $product->imageURL,
                "quality" => 1,
                "price" => $product->price
                ]
            ];
        };
        

        return (array)$product;
    }

    function deleteItem($id){
        
        return "items delete";
    }
}
