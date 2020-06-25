@extends('layouts.admin')

@section('title', 'Admin')
    
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
<h1 class="h3 mb-2 text-gray-800">Admin</h3>
<p class="mb-4">This is a simple Admin table as you can add and delete Admins.</a>.</p>
<p>
    <a href="{{route('admin.create')}}" class="btn btn-primary" >Add admin</a>
</p>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admins Table</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Delete</th>
          </tr>
        </thead>
        @php
            $counter = 0;    
        @endphp
        <tbody>
            @foreach ($admins as $admin)
              @if ($admin->id != Auth::guard('admin')->user()->id)
              <tr>
                <th scope="row">{{$counter+=1}}</th>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                  <td>
                      <form action="{{route('admin.destroy',['admin'=>$admin])}}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                  </td>
              </tr>
              @endif
            @endforeach
        </tbody>
    </table>
    {{-- {{ $admins->links() }} --}}
</div>

@endsection