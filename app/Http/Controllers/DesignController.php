<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use App\Tag;
use Auth;
use App\Design;
use App\DesignImage;
use App\User;
use App\DesignerRate;
use App\DesignVote;
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
        // $designers=[];
        // $rates=DesignerRate::whereHas('designer', function($query){
        //     $query->where('role','=','designer');
        // })->select('designer_id',DB::raw('AVG(rate) as rate'))->groupBy('designer_id')->orderBy('rate','desc')->limit(5)->get();
        // foreach ($rates as $rate) {
        //     $designer=User::find($rate->designer_id);
        //     array_push($designers,$designer); 
        // }
        $desings=Design::paginate(9);
        $maxPrice=Design::all()->max('price');
        $minPrice=Design::all()->min('price');
        return view('designs.index',compact('desings','maxPrice','minPrice'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vote(Request $request)
    {
        // echo $id;
        $design=Design::find($request->design_id);
        if($request->vote == "add")
        {
           DesignVote::create(['design_id'=>$design->id,
            'user_id'=>Auth::id()]);
            $design->total_likes =$design->total_likes +1;
            $design->save(); 
        }
        else if($request->vote == "remove")
        {
            $vote=DesignVote::all()->where('design_id','=',$design->id)->first();
            $vote->delete();
            $design->total_likes =$design->total_likes -1;
            $design->save(); 
        }
        
        echo $design->total_likes;
    }
    
    public function filterBy(Request $request)
    {
        $filterType=$request->filterType ;
        $category=$request->category;
        $minPrice=$request->minPrice;
        $minarr=explode('$', $minPrice);
        $min=(int)$minarr[1];
        $maxPrice=$request->maxPrice;
        $maxarr=explode('$', $maxPrice);
        $max=(int)$maxarr[1];
        $designs=[];
        $newArray=[];
        // echo $maxPrice;
        if($filterType && !$category)
        {  
            if($filterType == 'Top Rated')
            {
                $designs=Design::all()->whereBetween('price',[$min,$max])->sortByDesc('total_likes');
            }
            else if($filterType == 'Latest')
            {
                $designs=Design::all()->whereBetween('price',[$min,$max])->sortByDesc('created_at');
            }
        }
        else if(!$filterType && $category)
        {
             $designs=Design::all()->whereBetween('price',[$min,$max])->where('category',$category);

        }
        else if($filterType && $category)
        {
            if($filterType == 'Top Rated')
            {
                $designs=Design::all()->whereBetween('price',[$min,$max])->where('category',$category)->sortByDesc('total_likes');

            }
            else if($filterType == 'Latest')
            {
                $designs=Design::all()->whereBetween('price',[$min,$max])->where('category',$category)->sortByDesc('created_at');
            }
        }
        else if(!$filterType && !$category)
        {
            $designs=Design::all()->whereBetween('price',[$min,$max]);
        }
        foreach($designs as $design){ 
            $design->{'image'}=$design->images()->first()->image;
            $design->{'designer'}=$design->designer->name;
            array_push($newArray,$design);
        }

        return response()->json([
            'designs' => $newArray
        ]);
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
        $tags=Tag::all();
        return view('designs.create',compact('designMaterial','design','tags'));
        
    }
    public function checkImageExtension($files)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesignsRequest $request)
    {
        $validated = $request->validated();
        if($request->hasFile('images') && $request->hasFile('sourceFile') )
        {
            $files = $request->file('images');
            $allowedfileExtension=['jpg','png','jpeg'];
            foreach($files as $file){
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if(! $check)
                {
                        return Redirect::back()->with('error','Sorry Only Upload png , jpg ,jpeg Images');
                }
            }
            $file=$request->file('sourceFile');
            $filePath = $file->store('Files','public');
            $design= Design::create(['title'=> $request->title,
                        'description'=>$request->description,
                        'price'=>$request->price,
                        'category'=>$request->category,
                        'designer_id'=>Auth::id(),
                        'source_file'=> $filePath,
                        'tag_id'=>$request->tag_id
            ]);
            $design->materials()->attach($request->Material);
            // $tags = explode(",", $request->tags);
            // $design->attachTags($tags);
            foreach ($request->images as $image) {
                        $filename = $image->store('Designs','public');
                        DesignImage::create([
                        'design_id' => $design->id,
                        'image' => $filename
                    ]);
            }
            return redirect("design/".$design->id)->with('success','Design added successfuly');
            
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
        $design = Design::findOrFail($id);
        $tag=$design->tag();
        $voted="False";
        $designImages=DesignImage::all()->where('design_id','=',$id);
        $RelatedDesigns=Design::whereHas('tag', function($query){$query->where('name','=','dress');})->get();
        $votes=$design->votes;
        foreach ($votes as $vote) {
            if($vote->user_id == Auth::id())
            {
                $voted="True";
                break;
            }
        }
        return view('designs.show',compact('voted','RelatedDesigns','design','designImages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $design = Design::find($id);
        $designMaterial=Material::all();
        $tags=Tag::all();
        $designImages=DesignImage::all()->where('design_id','=',$id);
        return view('designs.edit',compact('design','designMaterial','tags','designImages'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Design $design)
    {
         $validatedData = $request->validate([
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
            'sourceFile'  => 'sometimes|mimes:pdf|max:10000',
            'images' => 'sometimes',
            'images.*' => 'mimes:jpg,jpeg,png',
            'tag_id' => 'required',
            'Material' => 'required'
        ]);
        // dd($request);
        $design=Design::find($design->id);
        $design->update($request->all());
        if ( $request->hasFile('sourceFile') ) 
        {
            $file=$request->file('sourceFile');
            $filePath = $file->store('Files','public');
            $design ->source_file=$filePath ;   
        }
        $design->materials()->sync($request->Material, false);
        // Images
        if($request->hasFile('images'))
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
            foreach ($design->images as $image) {

                        $image->delete();
            }

            foreach ($request->images as $image) {
                 $filename = $image->store('Designs','public');
                        DesignImage::create([
                        'design_id' => $design->id,
                        'image' => $filename
                        ]);
                        
            }              
        }

        return redirect("design/".$design->id)->with('success','Design Upadated Successfuly');
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
        $design = Design::findOrFail($id);
        $design->delete();
        return redirect('designer/'.Auth::id())->with('success','Design deleted successfully ');
    }
}
