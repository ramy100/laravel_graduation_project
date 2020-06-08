<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use \App\Design;
use \App\DesignerRate;
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
        // ->paginate(10);
        ->take(10)//limit the images to Top 10 favorite images.
        ->get();
        print($designers);
        return view('designer\designerslist',['designers'=>$designers]);
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
        print($user);
        $designer = User::findOrFail($id);
        $current_designs = Design::where('designer_id', $id)->get();
        return view('designer\profile',['designer'=>$designer,'user'=>$user,'current_designs'=>$current_designs]);

          
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('designer.edit',['designer'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //validation
        //update

        $designer = User::findOrFail($id);
        $designer->name = $request->name;
        $designer->address = $request->address;
        if($request->hasfile('image')){      
        $file= $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('storage/uploads',$filename);
        $designer->image = $filename;
        }
        else {
            return $request;
            $designer->image='';
        }
        //redirect
        if($designer->save()){
            return redirect()->route('home')->withSuccess('S-a incarcat cu success!');
        }else{
            return redirect()->route('home')->withDanger('Nu s-a incarcat! A aparut o eroare.');
        }
        // $designer->password = $request->password;

    }

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
        $designer->delete;
        return redirect()->route('home');
    }
}
