<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth; 

class ProfileController extends Controller
{
    public function create()
    {
        $info = Profile::where('user_id',Auth::id())->get();
        // var_dump($info);
        if($info->count() == 0)
        {
            $profile = new Profile();
            return view('designer.about',compact('profile'));
        }
        else
        {
            
            return redirect(route('user.edit',Auth::id()));
        }
        
    }
    public function store(Request $request)
    {
        $profile = new Profile();
        $profile->about = $request->about;
        $profile->user_id = Auth::id();
        $profile->save();
        return redirect("designer/".$profile->user_id);

    }
}

