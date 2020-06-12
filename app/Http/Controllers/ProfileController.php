<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Auth; 
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function create()
    {
        $info = Profile::where('user_id',Auth::id())->get();
        if($info[0]['about'] == NULL)
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
                // print();

        DB::table('profiles')
              ->where('user_id',Auth::id() )
              ->update(['about' => $request->about]);
        $profile = Profile::findOrFail(Auth::id());
        return redirect("designer/".$profile->user_id);

    }
}

