@extends('layouts.admin')

@section('title', 'Add Tag')
    


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Add an Admin</h3>
            </div>
        </div>
    
        <div class="row">
            <div class="col-3">
                <form action="{{route('admin.store')}}" method="POST">
                    
                    @include('dashboard.admins.form')
    
                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
@endsection
