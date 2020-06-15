@extends('layouts.admin')

@section('title', 'Add Tag')
    


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Add Tag</h3>
            </div>
        </div>
    
        <div class="row">
            <div class="col-3">
                <form action="{{route('tag.store')}}" method="POST">
                    
                    @include('tags.form')
    
                    <button type="submit" class="btn btn-primary">Add Tag</button>
                </form>
            </div>
        </div>
    </div>
@endsection
