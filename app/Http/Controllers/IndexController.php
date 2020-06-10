<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Design;
use App\Tag;
use App\User;
class IndexController extends Controller
{
    public function index(){

        $latestDesigns = Design::orderBy('id', 'desc')->take(8)->get();
        $tags = Tag::get()->all();
        $topDesigns = Design::orderBy('total_likes', 'desc')->take(8)->get();
        $companies = User::where('role', '=', 'company')->get();

        $role = is_null(auth()->user()) ? 'm3l4' : auth()->user()->role;
         
        return view('welcome', compact('latestDesigns', 'tags', 'topDesigns', 'companies', 'role'));
    }

   
    
}
