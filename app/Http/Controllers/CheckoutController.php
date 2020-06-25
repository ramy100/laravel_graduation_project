<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('check-role:company');
        $this->middleware('check-verification:accepted');
    }
    
    public function checkout(){
        $user = Auth::user();
        return view('cart.checkout');
    }
    
}
