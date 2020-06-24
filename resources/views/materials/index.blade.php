@extends('layouts.admin')

@section('title', 'Materials')
    
@section('content')
@if (session()->has("message"))
<div class="alert alert-success" role="alert">
    <strong>Success</strong> {{session()->get("message")}}
  </div>
@endif
@if (session()->has("deleted"))
<div class="alert alert-warning" role="alert">
    {{session()->get("deleted")}}
  </div>
@endif
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Materials</h3>
    <p class="mb-4">This is a simple material table as you can add edit and delete materials.</a>.</p>
    <p>
        <a href="{{route('material.create')}}" class="btn btn-primary" >Add Material</a>
    </p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Materials Table</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
            </thead>
            @php
                $counter = 0;    
            @endphp
            <tbody>
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
    {{ $materials->links() }}
</div>

@endsection