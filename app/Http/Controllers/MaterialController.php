<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::all();
        return view('materials.index',compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material = new Material();
        return view('materials.create', compact('material'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $material = Material::create($request->validate([
            'name'=>'required|min:3|unique:materials',
        ]));
        return redirect('admin/material')->with('message','a new material has been added ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        return view('materials.edit',compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
        $material->update($request->validate([
            'name'=>['required', 'min:3',
            Rule::unique('materials', 'name')->ignore($material->id)->where(function ($query) { return $query->where('deleted_at', null); })]
        ]));
        return redirect('admin/material')->with('message','material has been updated successfully ^_^');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        if(count($material->designs)){
            return redirect('admin/material')->with('deleted',"Can't delete this because it has been added to a design");
        }
        $material->delete();
        return redirect('admin/material')->with('deleted','Material has been deleted successfully ');
    }
}
