<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \App\Design;
use \App\DesignerRate;
use \App\DesignImage;
use Auth;
use Illuminate\Support\Facades\DB;

class DesignerController extends Controller
{
    // public function __construct(){

    // }

    // public function showRegistrationForm()
    // {
    //     return view('auth.allregister',[
    //         'route'=>'designer.register',
    //         'role'=>'Designer'
    //     ]);
    // }


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
        $designers = DB::table('users')
        ->join('designer_rates', 'designer_rates.designer_id', '=', 'users.id')
        ->select('designer_id','users.name','users.image', DB::raw('count(*) as total'))
        ->orderBy('total', 'desc') //order in descending order
        ->groupBy('designer_id')
        // ->take(10)//limit the images to Top 10 favorite images.
        // ->get();
        ->paginate(10);
        // print($designers);
        return view('designer.designerslist',['designers'=>$designers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        // print($user);
        $designer = User::findOrFail($id);
        $current_designs = Design::where('designer_id', $id)->get();
        $likes_count =User::find($id)->designer_rates->count();
        // $designs = Design::where('designer_id',$id)->get();
        // print($designs);
        // $image_array=[];
        // foreach($designs as $design)
        // {
        // $design_image = DesignImage::where('design_id',$design[0]["id"])->first()->get();
        // array_push($image_array, $design_image); 
        // }
        // print($image_array);
        // print($likes_count);
        return view('designer.profile',['designer'=>$designer,'user'=>$user,'current_designs'=>$current_designs,'likes'=>$likes_count]);
          
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('designer.edit',['designer'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {

    //     //validation
    //     //update

    //     $designer = User::findOrFail($id);
    //     $designer->name = $request->name;
    //     $designer->address = $request->address;
    //     if($request->hasfile('image')){      
    //     $file= $request->file('image');
    //     $extension = $file->getClientOriginalExtension();
    //     $filename = time().'.'.$extension;
    //     $file->move('storage/uploads',$filename);
    //     $designer->image = $filename;
    //     }
    //     else {
    //         return $request;
    //         $designer->image='';
    //     }
    //     //redirect
    //     if($designer->save()){
    //         return redirect()->route('home')->withSuccess('S-a incarcat cu success!');
    //     }else{
    //         return redirect()->route('home')->withDanger('Nu s-a incarcat! A aparut o eroare.');
    //     }
    //     // $designer->password = $request->password;

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        print("Destroooooooooooooooooy");
        $designer = User::find($id);
        $designer->delete();
        return redirect()->route('home');
    }
    
    public function savelikes(Request $request){
        $id = $request->get('id');
        $check =DesignerRate::where(['designer_id'=>$id,'liker_id'=> Auth::user()["id"]])->get();
            if($check->count() > 0 )
            {
                
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

                
                
            }
        return response()->json(['success'=>'Got Simple Ajax Request.','input'=>$id,'exist'=>$exist]);
    }
}
