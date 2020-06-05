<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use Spatie\Tags\Tag;
use Auth;
use App\Design;
use App\DesignImage;
use App\User;

use App\Http\Requests\StoreDesignsRequest;
use Redirect;
use DB;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designers=DB::table('users')->where('role','=','designer')->limit(5)->get();
        $desings=Design::all();
        $maxPrice=Design::all()->max('price');
        $minPrice=Design::all()->min('price');
        return view('designs.index',compact('designers','desings','maxPrice','minPrice'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $design = new Design();
        $designMaterial=Material::all();
        return view('designs.create',compact('designMaterial','design'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesignsRequest $request)
    {
        echo "hi";
        $validated = $request->validated();
        // dd($request);
        if($request->hasFile('images') && $request->hasFile('sourceFile') )
        {
            $allowedfileExtension=['jpg','png','jpeg'];
            $files = $request->file('images');
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if(! $check)
                {
                    return Redirect::back()->with('error','Sorry Only Upload png , jpg ,jpeg Images');
                }
            }
            $file=$request->file('sourceFile');
            if ($file->getClientOriginalExtension() == 'pdf' )
            {
                    $filePath = $file->store('Files','public');
                    $design= Design::create(['title'=> $request->title,
                        'description'=>$request->description,
                        'price'=>$request->price,
                        'category'=>$request->category,
                        'designer_id'=>Auth::id(),
                        'source_file'=> $filePath,
                    ]);
                    $design->materials()->attach($request->Material);
                    $tags = explode(",", $request->tags);
                    $design->attachTags($tags);
                    foreach ($request->images as $image) {
                        $filename = $image->store('Designs','public');
                        DesignImage::create([
                        'design_id' => $design->id,
                        'image' => $filename
                        ]);
                    }
                return Redirect::back()->with('success','Design added successuly');
            }
            else
            {
                return Redirect::back()->with('error','Sorry Only Upload pdf file ');
            }
            
        }
        else
        {
            return Redirect::back()->with('error','Sorry you have to add both File and Images');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $design = Design::find($id)->where('designer_id' , '=',Auth::id())->get()->first();
        $designMaterial=Material::all();
        return view('designs.edit',compact('design','designMaterial'));
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
