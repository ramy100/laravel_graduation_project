<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Design;
use Auth;
use Cart;
use Darryldecode\Cart\CartCondition;

class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('check-role:company');
        // $this->middleware('check-verification:accepted');
    }
    public function result(Request $request){
        
       // dd();
       $designs=session('designs');
        return view('designs.bought-designs', compact('designs'));
    }

    public function cart(){
        
        $userID = Auth::user()->id;
        $items = Cart::session($userID)->getContent();
        return view('cart.cart', compact('items'));
    }
    
    public function addToCart(Request $request){
        $userID = Auth::user()->id;
        $design_id = $request->id;

        $design = Design::find($design_id);

        $check = Cart::session($userID)->get($design_id);
        // check if the item already exist in cart or not to add it
        if(is_null($check)){
            Cart::session($userID)->add(array(
                'id' => $design_id, // inique row ID
                'name' => $design->title,
                'price' => $design->price,
                'quantity' => 1,
                'attributes' => array(
                    'image' => $design->images()->first()->image
                )
            ));

            $count = Count(Cart::session($userID)->getContent());

            return response()->json([
                'status' => '1',
                'count' => $count,
                'msg' => 'Design added to cart successfully!'
            ]);
        }else{
            
            return response()->json([
                'status' => '0',
                'msg' => 'Already in cart!'
            ]);
        }
    }

    public function removeFromCart(Request $request){

        $userID = Auth::user()->id;
        $design_id = $request->id;
        $check = Cart::session($userID)->get($design_id);
        // check if the item already exist in cart or not to remove it
        if($check){

            Cart::session($userID)->remove($design_id);
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

    public function emptyCart(){
        $userID = Auth::user()->id;
        Cart::session($userID)->clear();
        return back();
    }

    // method for loading the cart view with data
    public function loadCartData(){

        $userID = Auth::user()->id;
        $items = Cart::session($userID)->getContent();
        if(Cart::session($userID)->isEmpty()){
            $count = 0;
        }
        else{
            $count = Count($items);
        }

        $view = view('cart.cart-data', compact('items'))->render();
        return response()->json(['status' => true, 'html' => $view, 'count' => $count]);
    }

}
