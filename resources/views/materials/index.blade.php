@extends('layouts.app')

@section('title', 'Materials')
    
@section('content')
@if (session()->has("message"))
<div class="alert alert-success" role="alert">
    <strong>Success</strong> {{session()->get("message")}}
  </div>
@endif
@if (session()->has("deleted"))
<div class="alert alert-warning" role="alert">
    <strong>Success</strong> {{session()->get("deleted")}}
  </div>
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            <h3>Materials</h3>
                <p><a href="{{route('material.create')}}" class="btn btn-primary" >Add material</a></p>
        </div>
    </div>

    <table class="table text-center table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @php
                $counter = 0;    
            @endphp
            @foreach ($materials as $material)
                <tr>
                <th scope="row">{{$counter+=1}}</th>
                    <td>{{$material->name}}</td>
                    <td>
                        <a href="{{route('material.edit',['material'=>$material])}}" class="btn btn-warning">Edit</a>
                    </td>
                    <td>
                        <form action="{{route('material.destroy',['material'=>$material])}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection