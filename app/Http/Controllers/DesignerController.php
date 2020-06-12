<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use \App\Design;
use \App\DesignerRate;
use \App\DesignImage;
use App\Profile;
use App\CompanyDesign;
use Auth;
use Illuminate\Support\Facades\DB;

class DesignerController extends Controller
{
    protected function create(array $data)
    {
        if(array_key_exists("image",$data))
            $image = $data['image']->store('uploads', 'public');
        else
            $image="images/default.jpg";

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'image' => $image,
            'role' => 'designer',
            'password' => Hash::make($data['password']),
        ]);
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $designers = DB::table('users')
        // ->join('designer_rates', 'designer_rates.designer_id', '=', 'users.id')
        // ->select('designer_id','users.name','users.image', DB::raw('count(*) as total'))
        // ->orderBy('total', 'desc') //order in descending order
        // ->groupBy('designer_id')
        // // ->take(10)//limit the images to Top 10 favorite images.
        // // ->get();
        // ->paginate(10);
        $designers = User::where('role','designer')->orderBy('likes', 'DESC')->paginate(10);
        // var_dump($designers);
        return view('designer.designerslist',['designers'=>$designers]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $vote_exist =  DesignerRate::where(['designer_id'=> $id,'liker_id'=>Auth::id()])->get();
        $about = Profile::where('user_id',$id)->get();
        $designer = User::where(['role'=>'designer','id'=>$id])->get();
        $current_designs = Design::where('designer_id', $id)->get()->count();
        $likes_count =User::findOrFail($id)->likes;
        $designs = Design::where('designer_id',$id)->get();
        $cimage_array=[];
        foreach($designs as $design)
        {
            $design_image = DesignImage::where('design_id',$design->id)->get();
        array_push($cimage_array, $design_image[0]); 
        }
        $featured_designs = Design::where(['designer_id'=>$id,'featured'=>1])->get();
        $fimage_array=[];
        foreach($featured_designs as $design)
        {
            $featured_image = DesignImage::where('design_id',$design->id)->get();
        array_push($fimage_array, $featured_image[0]); 
        }
        $prev_works = Design::where(['designer_id'=>$id,'state'=>'sold'])->get();
        $prev_work_count = $prev_works->count();
        foreach($prev_works as $prev_work)
        {
            $prev_images = CompanyDesign::where('design_id',$prev_work->id)->get();

        }            
        return view('designer.profile',['designer'=>$designer,'user'=>$user,'vote_exist'=>$vote_exist,'design_count'=>$current_designs,'featured_images'=>$fimage_array,'current_images'=>$cimage_array,'likes'=>$likes_count,'about'=>$about,'prev_img'=>$prev_images,'prev_count'=>$prev_work_count]);       
    }    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $designer = User::find($id);
        $designer->delete();
        return redirect()->route('home');
        // return redirect()->route('logout',$id);
    }
    
    public function savelikes(Request $request){
        $id = $request->get('id');
        $check =DesignerRate::where(['designer_id'=>$id,'liker_id'=> Auth::user()["id"]])->get();
            if($check->count() > 0 )
            {
                $designer = User::find($id);
                $likes  = $designer->likes - 1;
                $designer->likes = $likes ;
                $designer->save(); 

                DesignerRate::where(['designer_id'=>$id,'liker_id'=> Auth::user()["id"]])->delete();
                $exist =0;

            }
            else
            {
                $new_rate = new DesignerRate;
                $new_rate->designer_id = $id; 
                $new_rate->liker_id =Auth::user()["id"];
                $new_rate->save();
                $exist =1;
                $designer = User::find($id);
                $likes  = $designer->likes + 1;
                $designer->likes = $likes ;
                $designer->save();              
                
            }
        return response()->json(['success'=>'Got Simple Ajax Request.','likes'=>$likes,'input'=>$id,'exist'=>$exist]);
    }
    public function featuredesign($design)
    {
        $specific_design = Design::find($design);
        $specific_design->featured = 1;
        $specific_design->save();
        return Redirect::back()->with('success','Design added successfuly');
    }
}
