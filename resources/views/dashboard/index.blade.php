@extends('layouts.admin')
@section('content')
  <h3>Welcome {{ Auth::guard('admin')->user()->name }}</h3>
@endsection