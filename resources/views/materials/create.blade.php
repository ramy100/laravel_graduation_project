@extends('layouts.app')

@section('title', 'Add Material')
    


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Add Material</h3>
            </div>
        </div>
    
        <div class="row">
            <div class="col-3">
                <form action="{{route('material.store')}}" method="POST">
                    
                    @include('materials.form')
    
                    <button type="submit" class="btn btn-primary">Add Material</button>
                </form>
            </div>
        </div>
    </div>
@endsection
