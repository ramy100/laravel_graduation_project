<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Design;
use App\Tag;
class IndexController extends Controller
{
    public function index(){

        $latestDesigns = Design::orderBy('id', 'desc')->take(8)->get();
        $tags = Tag::get()->all();
        $topDesigns = Design::orderBy('total_likes', 'desc')->take(8)->get();
        return view('welcome', compact('latestDesigns', 'tags', 'topDesigns'));
    }

    
}
