@extends('layouts.app')

@section('title', 'Edit Material'.$material->name)
    


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Edit Material for: {{$material->name}}</h3>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <form action="{{ route('material.update', ['material'=> $material]) }}" method="POST">
                    @method('PATCH')
                    @include('materials.form')
                    
                    <button type="submit" class="btn btn-primary">Save Material</button>
                </form>
            </div>
        </div>
    </div>
@endsection