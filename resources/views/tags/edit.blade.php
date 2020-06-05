@extends('layouts.app')

@section('title', 'Edit Tag'.$tag->name)
    


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Edit Tag for: {{$tag->name}}</h3>
            </div>
        </div>
    
        <div class="row">
            <div class="col-12">
                <form action="{{ route('tag.update', ['tag'=> $tag]) }}" method="POST">
                    @method('PATCH')
                    @include('tags.form')
                    
                    <button type="submit" class="btn btn-primary">Save Tag</button>
                </form>
            </div>
        </div>
    </div>
@endsection