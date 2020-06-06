<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Design;

class IndexController extends Controller
{
    public function index(){

        $latestDesigns = Design::take(12)->get();
        return view('welcome', compact('latestDesigns'));
    }

    
}
