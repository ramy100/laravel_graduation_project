@extends('layouts.admin')
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Designer chart</h1>
    <p class="mb-4">This is a simple designer chart table as you can get acces to each design likes chart per day.</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Designers Table</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Start date</th>
                <th>Likes Chart</th>
              </tr>
            </thead>
            @php
                $counter = 0;    
            @endphp
            <tbody>
                @foreach ($designers as $designer)               
                <tr>
                  <td>{{$counter+=1}}</td>
                  <td>{{ $designer->name }}</td>
                  <td>{{ $designer->email }}</td>
                  <td>{{ $designer->created_at }}</td>
                  <td>
                      <a href="{{route('designer.chart',['id'=>$designer])}}" class="btn btn-info">Chart</a>
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

@endsection