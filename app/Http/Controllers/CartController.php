<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Design;

use Cart;
use Darryldecode\Cart\CartCondition;

class CartController extends Controller
{
    public function cart(){
        
        $items = Cart::getContent();
   
        return view('cart.cart', compact('items'));
    }

    public function addToCart(Request $request){

        $design_id = $request->id;
        $design = Design::find($design_id);

        $check = Cart::get($design_id);
        // check if the item already exist in cart or not to add it
        if(is_null($check)){
            Cart::add(array(
                'id' => $design_id, // inique row ID
                'name' => $design->title,
                'price' => $design->price,
                'quantity' => 1,
                'attributes' => array(
                )
            ));

            $count = Count(Cart::getContent());

            return response()->json([
                'status' => '1',
                'count' => $count,
                'msg' => 'added successfully!'
            ]);
        }else{
            
            return response()->json([
                'status' => '0',
                'msg' => 'Already in cart!'
            ]);
        }
    }

    public function removeFromCart(Request $request){

        $design_id = $request->id;
        $check = Cart::get($design_id);
        // check if the item already exist in cart or not to remove it
        if($check){

            Cart::remove($design_id);
            return response()->json([
                'status' => '1',
                'msg' => 'removed successfully!'
            ]);

        }else{
            return response()->json([
                'status' => '0',
                'msg' => 'error in cart!'
            ]);
        }
    }

    // method for loading the cart view with data
    public function loadCartData(){

        $items = Cart::getContent();
        if(Cart::isEmpty()){
            $count = 0;
        }
        else{
            $count = Count($items);
        }

        $view = view('cart.cart-data', compact('items'))->render();
        return response()->json(['status' => true, 'html' => $view, 'count' => $count]);
    }

    public function emptyCart(){
        CArt::clear();
        return back();
    }
}
